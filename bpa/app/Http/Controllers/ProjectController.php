<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where(
            'division_id',
            Auth::user()->division_id
        )->get();

        return view('projects', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_project' => 'required|date',
            'end_project' => 'required|date',
        ]);

        Project::create([
            'name' => $request->name,
            'start_project' => $request->start_project,
            'end_project' => $request->end_project,
            'division_id' => Auth::user()->division_id,
        ]);

        return redirect()->back();
    }
}