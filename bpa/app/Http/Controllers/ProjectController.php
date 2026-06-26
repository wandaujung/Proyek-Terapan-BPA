<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProjectController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();

    $query = Project::where(function($q) use ($user) {
        $q->where('division_id', $user->division_id)
          ->orWhereHas('members', function($q2) use ($user) {
              $q2->where('user_id', $user->id);
          });
    });

    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $projects = $query->get();
    $users = User::all();

    return view('projects', compact('projects', 'users'));
}

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'start_project' => 'required|date',
        'end_project' => 'required|date',
    ]);

    $project = Project::create([
        'name' => $request->name,
        'start_project' => $request->start_project,
        'end_project' => $request->end_project,
        'division_id' => Auth::user()->division_id,
    ]);

    // attach members
    if ($request->members) {
        $project->members()->attach($request->members);
    }

    // Refresh members relationship to include newly attached members
    $project->load('members');

    // Notify division staff, collaborators, and managers
    $divisionUsers = User::where('division_id', $project->division_id)->get();
    $members = $project->members;
    $managers = User::whereHas('division', function($q) {
        $q->where('name', 'Manager');
    })->get();
    $usersToNotify = $divisionUsers->merge($members)->merge($managers)->unique('id');

    foreach ($usersToNotify as $userToNotify) {
        $userToNotify->notify(new \App\Notifications\ProjectNotification($project, 'added'));
    }

    return redirect()->back()->with('success', 'Project "' . $project->name . '" has been successfully created!');
}

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('edit-project', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'start_project' => 'required|date',
            'end_project' => 'required|date',
            'division_id' => 'sometimes|exists:divisions,id',
        ]);

        $project = Project::findOrFail($id);

        $updateData = [
            'name' => $request->name,
            'start_project' => $request->start_project,
            'end_project' => $request->end_project,
        ];

        if ($request->has('division_id')) {
            $updateData['division_id'] = $request->division_id;
        }

        $project->update($updateData);

        // Sync members
        if ($request->has('members')) {
            $project->members()->sync($request->members);
        } else {
            $project->members()->detach();
        }

        // Notify division staff, collaborators, and managers about project update
        $project->load('members');
        $divisionUsers = User::where('division_id', $project->division_id)->get();
        $members = $project->members;
        $managers = User::whereHas('division', function($q) {
            $q->where('name', 'Manager');
        })->get();
        $usersToNotify = $divisionUsers->merge($members)->merge($managers)->unique('id');

        foreach ($usersToNotify as $userToNotify) {
            $userToNotify->notify(new \App\Notifications\ProjectNotification($project, 'updated'));
        }

        if (Auth::user()->division && Auth::user()->division->name === 'Manager') {
            return redirect()->route('manager.projects.index')->with('success', 'Project "' . $project->name . '" has been successfully updated!');
        }

        return redirect()->route('projects')->with('success', 'Project "' . $project->name . '" has been successfully updated!');
    }

    public function destroy($id)
    {
        $project = Project::with('members')->findOrFail($id);

        // Notify division staff, collaborators, and managers before deletion
        $divisionUsers = User::where('division_id', $project->division_id)->get();
        $members = $project->members;
        $managers = User::whereHas('division', function($q) {
            $q->where('name', 'Manager');
        })->get();
        $usersToNotify = $divisionUsers->merge($members)->merge($managers)->unique('id');

        foreach ($usersToNotify as $userToNotify) {
            $userToNotify->notify(new \App\Notifications\ProjectNotification($project, 'removed'));
        }

        $project->delete();

        if (Auth::user()->division && Auth::user()->division->name === 'Manager') {
            return redirect()->route('manager.projects.index')->with('success', 'Project has been deleted successfully!');
        }

        return redirect()->back()->with('success', 'Project has been deleted successfully!');
    }
    public function searchUsers(Request $request)
{
    $search = $request->search;

    $users = User::where('email', 'LIKE', "%{$search}%")
        ->limit(5)
        ->get();

    return response()->json($users);
}
public function tasks($id)
{
    $project = Project::with(['tasks.subTasks', 'members', 'division'])->findOrFail($id);

    $todoTasks     = $project->tasks->where('status', 'todo');
    $progressTasks = $project->tasks->where('status', 'progress');
    $reviewTasks   = $project->tasks->where('status', 'review');
    $doneTasks     = $project->tasks->where('status', 'done');

    // Get available users (same division + collaborators)
    $divisionUsers = User::where('division_id', $project->division_id)->get();
    $collaborators = $project->members;
    $availableUsers = $divisionUsers->merge($collaborators)->unique('id');

    // Get all managers for submit review autocomplete
    $managers = User::whereHas('division', function($query) {
        $query->where('name', 'Manager');
    })->get();

    return view('task', compact('project', 'todoTasks', 'progressTasks', 'reviewTasks', 'doneTasks', 'availableUsers', 'managers'));
}
}