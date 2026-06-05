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

    return redirect()->back();
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
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'name' => $request->name,
            'start_project' => $request->start_project,
            'end_project' => $request->end_project,
        ]);

        return redirect()->route('projects');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect()->back();
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
    $project = Project::with(['tasks.subTasks', 'members'])->findOrFail($id);

    $todoTasks     = $project->tasks->where('status', 'todo');
    $progressTasks = $project->tasks->where('status', 'progress');
    $reviewTasks   = $project->tasks->where('status', 'review');
    $doneTasks     = $project->tasks->where('status', 'done');

    // Get available users (same division + collaborators)
    $divisionUsers = User::where('division_id', $project->division_id)->get();
    $collaborators = $project->members;
    $availableUsers = $divisionUsers->merge($collaborators)->unique('id');

    return view('task', compact('project', 'todoTasks', 'progressTasks', 'reviewTasks', 'doneTasks', 'availableUsers'));
}
}