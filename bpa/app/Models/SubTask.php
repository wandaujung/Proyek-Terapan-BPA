<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $table = 'sub_tasks';

    protected $fillable = [
        'task_id',
        'title',
        'is_completed',
        'sort_order',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
