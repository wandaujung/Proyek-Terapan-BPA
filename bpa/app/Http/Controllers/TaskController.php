<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\SubTask;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskReviewed;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('task', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'project_id' => 'required|exists:projects,id'
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'brief_link' => $request->brief_link,
            'user_id' => Auth::id(),
            'project_id' => $request->project_id,
            'status' => 'todo'
        ]);

        // Save sub-tasks
        if ($request->has('subtasks')) {
            $sortIndex = 0;
            foreach ($request->subtasks as $subtaskData) {
                $title = is_array($subtaskData) ? ($subtaskData['title'] ?? '') : $subtaskData;
                $isCompleted = is_array($subtaskData) ? ($subtaskData['is_completed'] ?? 0) : 0;
                
                if (!empty(trim($title))) {
                    SubTask::create([
                        'task_id' => $task->id,
                        'title' => trim($title),
                        'is_completed' => $isCompleted,
                        'sort_order' => $sortIndex++,
                    ]);
                }
            }
        }

        return back();
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'brief_link' => $request->brief_link,
            'submission_link' => $request->submission_link,
        ]);

        // Sync sub-tasks: delete old ones and recreate
        $task->subTasks()->delete();

        if ($request->has('subtasks')) {
            $sortIndex = 0;
            foreach ($request->subtasks as $subtaskData) {
                $title = is_array($subtaskData) ? ($subtaskData['title'] ?? '') : $subtaskData;
                $isCompleted = is_array($subtaskData) ? ($subtaskData['is_completed'] ?? 0) : 0;
                
                if (!empty(trim($title))) {
                    SubTask::create([
                        'task_id' => $task->id,
                        'title' => trim($title),
                        'is_completed' => $isCompleted,
                        'sort_order' => $sortIndex++,
                    ]);
                }
            }
        }

        return back();
    }

    public function submitBatch(Request $request, Project $project)
    {
        $request->validate([
            'manager_email' => 'required|email'
        ]);

        Task::where('project_id', $project->id)
            ->where('status', 'review')
            ->update([
                'review_status' => 'pending',
                'manager_email' => $request->manager_email
            ]);

        return back()->with('success', 'Tasks submitted for review');
    }

    public function submit(Request $request, Task $task)
    {
        $task->update([
            'status' => 'review',
            'review_status' => 'pending',
            'manager_email' => $request->manager_email
        ]);

        return back();
    }

    public function approve(Task $task)
    {
        $task->update([
            'status' => 'done',
            'review_status' => 'approved'
        ]);

        if ($task->user) {
            $task->user->notify(new TaskReviewed($task, 'approved'));
        }

        return back();
    }

    public function revision(Request $request, Task $task)
    {
        $task->update([
            'status' => 'progress',
            'review_status' => 'revision',
            'revision_notes' => $request->revision_notes
        ]);

        if ($task->user) {
            $task->user->notify(new TaskReviewed($task, 'revision', $request->revision_notes));
        }

        return back();
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:todo,progress,review,done'
        ]);

        $task->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }
}
