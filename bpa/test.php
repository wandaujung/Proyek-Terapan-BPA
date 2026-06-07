<?php
use Carbon\Carbon;
use App\Models\User;
use App\Models\Task;

foreach(User::all() as $u) { 
    if (!$u->division) continue;
    $d = $u->division_id; 
    $t = Carbon::today()->toDateString(); 
    $c = Task::whereHas('project', function($q) use ($d, $u) { 
        $q->where('division_id', $d)
          ->orWhereHas('members', function($q2) use ($u) { 
              $q2->where('user_id', $u->id); 
          }); 
    })
    ->where('status', '!=', 'done')
    ->where('end_date', '<=', $t)
    ->count(); 
    echo $u->name . ' - ' . $u->division->name . ' - ' . $c . "\n"; 
}
