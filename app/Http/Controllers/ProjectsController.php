<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Project;


class ProjectsController extends Controller
{
	public function index()
	{
		$projects = auth()->user()->accessibleProjects();

		return view('projects.index', compact('projects'));
	}

	public function create()
	{
		return view('projects.create');
	}

	public function store()
	{
		$project = auth()->user()->projects()->create($this->validateRequest());

		if (request()->has('tasks')) {
			$project->addTasks(request('tasks'));
		}

		if (request()->wantsJson()) {
			return ['message' => $project->path()];
		}
		
		return redirect($project->path());
	}

	public function edit(Project $project)
	{
		return view('projects.edit', compact('project'));
	}

	public function show(Project $project)
	{
		$this->authorize('show', $project);
		return view('projects.show', compact('project'));
	}

	public function update(UpdateProjectRequest $request, Project $project)
	{
		$request->save();
		return redirect($project->path());
	}

	public function destroy(Project $project)
	{
		$this->authorize('delete', $project);
		$project->delete();
		return redirect('/projects');
	}

	protected function validateRequest()
	{
		return request()->validate([
			'title' => 'sometimes|required',
			'description' => 'sometimes|required',
			'notes' => 'nullable'
		]);
	}
}
