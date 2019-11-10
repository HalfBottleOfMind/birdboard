<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Task extends Model
{
	use RecordsActivity;

	protected static $recordableEvents = ['created', 'deleted'];

    protected $guarded = [];

	protected $touches = ['project'];

	protected $casts = [
		'completed' => 'boolean'
	];

	public function complete()
	{
		$this->update(['completed' => true]);
		$this->activity()->create([
			'user_id' => auth()->check() ? auth()->id() : $this->project->owner->id,
			'project_id' => $this->project_id,
			'description' => 'completed_task'
		]);
	}

	public function incomplete()
	{
		$this->update(['completed' => false]);
		$this->activity()->create([
			'user_id' => auth()->check() ? auth()->id() : $this->project->owner->id,
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
}
