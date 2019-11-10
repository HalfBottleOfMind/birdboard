<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Task extends Model
{
    protected $guarded = [];

	protected $touches = ['project'];

	protected $casts = [
		'completed' => 'boolean'
	];

	public function complete()
	{
		$this->update(['completed' => true]);
		$this->activity()->create([
			'project_id' => $this->project_id,
			'description' => 'completed_task'
		]);
	}

	public function incomplete()
	{
		$this->update(['completed' => false]);
		$this->activity()->create([
			'project_id' => $this->project_id,
			'description' => 'incomplete_task'
		]);
	}

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return $this->project->path() . '/tasks/' . $this->id;
    }

	public function activity()
	{
		return $this->morphMany(Activity::class, 'subject')->latest();
	}

	public function recordActivity($description)
	{
		$this->activity()->create([
			'project_id' => $this->project_id,
			'description' => $description,
		]);
	}
}
