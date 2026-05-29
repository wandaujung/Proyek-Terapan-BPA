<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'start_project',
        'end_project',
        'division_id'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function members()
{
    return $this->belongsToMany(User::class, 'project_members');
}
}