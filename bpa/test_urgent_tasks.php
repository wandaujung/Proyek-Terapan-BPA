<?php

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;

$user = User::first(); // Assuming this is the logged in user
$divisionId = $user->division_id;
$today = Carbon::today()->toDateString();

$urgentTasks = Task::whereHas('project', function($q) use ($divisionId, $user) {
    $q->where('division_id', $divisionId)
      ->orWhereHas('members', function($q2) use ($user) {
          $q2->where('user_id', $user->id);
      });
})
->where('status', '!=', 'done')
->where('end_date', '<=', $today)
->with('project')
->orderBy('end_date', 'asc')
->limit(5)
->get();

echo "User: " . $user->name . " (Division: " . $divisionId . ")\n";
echo "Today: " . $today . "\n";
echo "Count: " . $urgentTasks->count() . "\n";
foreach ($urgentTasks as $task) {
    echo "Task ID: " . $task->id . ", End Date: " . $task->end_date . ", Urgency Label: " . $task->urgency_label . "\n";
}
