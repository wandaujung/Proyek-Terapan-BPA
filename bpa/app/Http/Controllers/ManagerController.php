<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $users = User::all();
        return view('project_manager', compact('divisions', 'users'));
    }

    public function storeProject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'start_project' => 'required|date',
            'end_project' => 'required|date|after_or_equal:start_project',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'division_id' => $request->division_id,
            'start_project' => $request->start_project,
            'end_project' => $request->end_project,
        ]);

        if ($request->has('members')) {
            $project->members()->attach($request->members);
        }

        // Notify division staff and collaborators
        $project->load('members');
        $divisionUsers = User::where('division_id', $project->division_id)->get();
        $members = $project->members;
        $usersToNotify = $divisionUsers->merge($members);

        foreach ($usersToNotify as $userToNotify) {
            $userToNotify->notify(new \App\Notifications\ProjectNotification($project, 'added'));
        }

        return redirect()->route('manager.projects.index')->with('success', 'Project created successfully!');
    }

    public function staffManagement()
    {
        $staff = User::with('division')
            ->where(function($query) {
                $query->whereHas('division', function($q) {
                    $q->where('name', '!=', 'Manager');
                })->orWhereNull('division_id');
            })
            ->get();

        $divisions = \App\Models\Division::where('name', '!=', 'Manager')->get();

        return view('staff_management', compact('staff', 'divisions'));
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'division_id' => 'required|exists:divisions,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'division_id' => $request->division_id,
        ]);

        return redirect()->back()->with('success', 'Akun staf "' . $request->name . '" berhasil dibuat.');
    }

    public function exportStaff()
    {
        $fileName = 'staff_data_' . date('Y-m-d') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $staff = User::with('division')
            ->where(function($query) {
                $query->whereHas('division', function($q) {
                    $q->where('name', '!=', 'Manager');
                })->orWhereNull('division_id');
            })
            ->get();

        $callback = function() use($staff) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Division', 'Registered At']);

            foreach ($staff as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->division ? $user->division->name : 'Unassigned',
                    $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function deleteStaff(User $user)
    {
        $name = $user->name;
        $user->delete();

        return redirect()->back()->with('success', 'Akun staf "' . $name . '" berhasil dihapus.');
    }

    public function importStaff(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        if (($handle = fopen($path, "r")) !== FALSE) {
            // Read headers
            $headers = fgetcsv($handle, 1000, ",");
            if (!$headers) {
                fclose($handle);
                return redirect()->back()->with('error', 'File CSV kosong atau tidak valid.');
            }

            // Normalize headers (strip BOM, lowercase, trim)
            $headers = array_map(function($header) {
                return strtolower(trim(preg_replace('/[\x00-\x1F\x7F-\x9F\xEF\xBB\xBF]/', '', $header)));
            }, $headers);

            // Check if required headers exist
            $required = ['name', 'email', 'password', 'division'];
            $missing = array_diff($required, $headers);
            if (count($missing) > 0) {
                fclose($handle);
                return redirect()->back()->with('error', 'Header CSV tidak sesuai. Kolom yang kurang: ' . implode(', ', $missing));
            }

            $line = 1;
            $successCount = 0;
            $importErrors = [];
            $emailsInBatch = [];

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $line++;
                
                // Skip empty lines
                if (count($data) === 1 && empty($data[0])) {
                    continue;
                }

                // Pad or slice data if columns count mismatch
                if (count($data) < count($headers)) {
                    $importErrors[] = "Baris {$line}: Jumlah kolom tidak sesuai dengan header.";
                    continue;
                }

                $row = array_combine($headers, array_slice($data, 0, count($headers)));

                $name = trim($row['name'] ?? '');
                $email = trim($row['email'] ?? '');
                $password = $row['password'] ?? '';
                $divisionName = trim($row['division'] ?? '');

                if (empty($name) || empty($email) || empty($password) || empty($divisionName)) {
                    $importErrors[] = "Baris {$line}: Data tidak lengkap (name, email, password, dan division wajib diisi).";
                    continue;
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $importErrors[] = "Baris {$line}: Format email '{$email}' tidak valid.";
                    continue;
                }

                if (strlen($password) < 6) {
                    $importErrors[] = "Baris {$line}: Password untuk '{$email}' harus minimal 6 karakter.";
                    continue;
                }

                if (in_array(strtolower($email), $emailsInBatch)) {
                    $importErrors[] = "Baris {$line}: Email '{$email}' duplikat di dalam file CSV.";
                    continue;
                }

                if (User::where('email', $email)->exists()) {
                    $importErrors[] = "Baris {$line}: Email '{$email}' sudah terdaftar.";
                    continue;
                }

                $division = \App\Models\Division::whereRaw('LOWER(name) = ?', [strtolower($divisionName)])->first();
                if (!$division || strtolower($divisionName) === 'manager') {
                    $importErrors[] = "Baris {$line}: Divisi '{$divisionName}' tidak valid. Divisi yang diperbolehkan: AC, Curriculum, MKLT, MKWK.";
                    continue;
                }

                $emailsInBatch[] = strtolower($email);

                User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'division_id' => $division->id,
                ]);

                $successCount++;
            }
            fclose($handle);
        }

        $message = "Berhasil mengimpor {$successCount} akun staf.";
        if (count($importErrors) > 0) {
            return redirect()->back()
                ->with('success', $message)
                ->with('import_errors', $importErrors);
        }

        return redirect()->back()->with('success', $message);
    }

    public function downloadTemplate()
    {
        $fileName = 'staff_import_template.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['name', 'email', 'password', 'division']);
            fputcsv($file, ['John Doe', 'john.doe@bpa.com', 'password123', 'Curriculum']);
            fputcsv($file, ['Jane Smith', 'jane.smith@bpa.com', 'secret456', 'AC']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
