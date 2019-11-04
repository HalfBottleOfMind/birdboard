<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;


class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => ''
        ]);
        $project = auth()->user()->projects()->create($attributes);
        return redirect($project->path());
    }

    public function show(Project $project)
    {
        $this->authorize('show', $project);
        return view('projects.show', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);
        $project->update(request(['notes']));
        return redirect($project->path());
    }
}
