<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class StaffDashboardController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $divisionId = $user->division_id;
        $divisionName = strtolower($user->division->name ?? 'ac');

        // Active Projects: projects in this division that have at least one non-done task, or have no tasks yet.
        $projects = Project::where('division_id', $divisionId)
            ->orWhereHas('members', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with('tasks')->get();

        $activeProjects = $projects->filter(function ($p) {
            return $p->tasks->count() === 0 || $p->tasks->where('status', '!=', 'done')->count() > 0;
        })->count();

        // Total tasks in this division
        $allTasks = Task::whereHas('project', function($q) use ($divisionId, $user) {
            $q->where('division_id', $divisionId)
              ->orWhereHas('members', function($q2) use ($user) {
                  $q2->where('user_id', $user->id);
              });
        })->get();
        $totalTasks = $allTasks->count();
        $doneTasks = $allTasks->where('status', 'done')->count();

        // Overall Task Success (percentage of done tasks)
        $taskSuccessPercent = $totalTasks > 0 ? round(($doneTasks / $totalTasks) * 100) : 0;

        // Completed Projects: projects where ALL tasks are done (and has at least 1 task)
        $completedProjects = $projects->filter(function ($p) {
            return $p->tasks->count() > 0 && $p->tasks->every(fn($t) => $t->status === 'done');
        })->count();

        // Tasks that are overdue (end_date < today) or due today, and not done
        $today = Carbon::today()->toDateString();
        $urgentTasks = Task::whereHas('project', function($q) use ($divisionId, $user) {
            $q->where('division_id', $divisionId)
              ->orWhereHas('members', function($q2) use ($user) {
                  $q2->where('user_id', $user->id);
              });
        })
            ->where('status', '!=', 'done')
            ->with('project')
            ->orderBy('end_date', 'asc')
            ->limit(5)
            ->get();

        // Members in this division, ranked by number of completed tasks
        $teamMembers = User::where('division_id', $divisionId)->get();
        $maxDone = 1; // avoid division by zero

        $teamPerformance = $teamMembers->map(function ($member) use ($divisionId) {
            $completedCount = Task::where('user_id', $member->id)
                ->whereHas('project', fn($q) => $q->where('division_id', $divisionId))
                ->where('status', 'done')
                ->count();

            return (object) [
                'name' => $member->name,
                'completed_tasks' => $completedCount,
            ];
        })->sortByDesc('completed_tasks')->values();

        if ($teamPerformance->count() > 0 && $teamPerformance->first()->completed_tasks > 0) {
            $maxDone = $teamPerformance->first()->completed_tasks;
        }
        
        // Latest 5 notifications for this user
        $recentActivity = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($notif) {
                $data = $notif->data;
                $action = $data['action'] ?? '';
                
                if ($action === 'approved') {
                    $icon = 'ti-circle-check-filled';
                    $message = 'Task approved and archived.';
                } elseif ($action === 'revision') {
                    $icon = 'ti-file-description';
                    $message = 'Revision requested: ' . ($data['notes'] ?? '');
                } elseif ($action === 'removed') {
                    $icon = 'ti-trash';
                    $message = 'Project removed from workspace.';
                } else {
                    $icon = 'ti-circle-plus-filled';
                    $message = 'Project added to workspace.';
                }

                return (object) [
                    'icon' => $icon,
                    'title' => $data['title'] ?? 'Notification',
                    'message' => $message,
                    'time' => $notif->created_at->diffForHumans(),
                ];
            });

        // Map view name based on division
        $viewName = 'dashboard_' . $divisionName;

        return view($viewName, compact(
            'activeProjects',
            'taskSuccessPercent',
            'totalTasks',
            'doneTasks',
            'completedProjects',
            'urgentTasks',
            'teamPerformance',
            'maxDone',
            'recentActivity'
        ));
    }
}
