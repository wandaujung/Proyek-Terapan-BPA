<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'brief_link',
        'submission_link',
        'status',
        'review_status',
        'manager_email',
        'revision_notes',
        'user_id',
        'project_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class)->orderBy('sort_order');
    }
}