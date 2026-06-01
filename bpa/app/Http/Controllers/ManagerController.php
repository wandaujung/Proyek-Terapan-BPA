<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $divisions = \App\Models\Division::with(['projects' => function($q) {
            $q->with(['tasks' => function($q2) {
                $q2->where('status', '!=', 'done')->with('user');
            }]);
        }])->get();

        $totalProjects = Project::count();
        $doneTasksCount = Task::where('status', 'done')->count();
        $totalTasksCount = Task::count();
        $overallSuccess = $totalTasksCount > 0 ? round(($doneTasksCount / $totalTasksCount) * 100) : 0;

        $completedProjectsCount = Project::whereDoesntHave('tasks', function($q) {
            $q->where('status', '!=', 'done');
        })->has('tasks')->count();

        $urgentTasks = Task::with('project')
            ->where('status', '!=', 'done')
            ->orderBy('end_date', 'asc')
            ->limit(3)
            ->get();

        $teamPerformance = \App\Models\User::withCount(['tasks' => function($q) {
            $q->where('status', '!=', 'done');
        }])->orderByDesc('tasks_count')->limit(3)->get();

        $recentActivities = \Illuminate\Support\Facades\DB::table('notifications')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function($notif) {
                $notif->data = json_decode($notif->data, true);
                return $notif;
            });

        $reviewTasks = Task::with(['user', 'project'])->where('status', 'review')->where('review_status', 'pending')->get();

        return view('dashboard_manager', compact(
            'divisions', 
            'totalProjects', 
            'overallSuccess', 
            'totalTasksCount', 
            'completedProjectsCount', 
            'urgentTasks', 
            'teamPerformance', 
            'recentActivities',
            'reviewTasks'
        ));
    }

    public function reviews()
    {
        $reviewTasks = Task::with(['user', 'project'])->where('status', 'review')->where('review_status', 'pending')->get();
        return view('reviews', compact('reviewTasks'));
    }

    public function reviewDetail(Task $task)
    {
        $task->load(['user', 'project', 'subTasks']);
        return view('review_detail', compact('task'));
    }

    public function projects()
    {
        $divisions = \App\Models\Division::with(['projects.tasks', 'projects.members'])->get();
        return view('project_manager', compact('divisions'));
    }

    public function storeProject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'start_project' => 'required|date',
            'end_project' => 'required|date|after_or_equal:start_project',
        ]);

        Project::create([
            'name' => $request->name,
            'division_id' => $request->division_id,
            'start_project' => $request->start_project,
            'end_project' => $request->end_project,
        ]);

        return redirect()->route('manager.projects.index')->with('success', 'Project created successfully!');
    }
}
