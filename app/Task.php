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
	
	protected static function boot() 
	{
		parent::boot();

		static::created(function($task) {
			$task->project->recordActivity($task->project, 'created_task');
		});
	}

	public function complete()
	{
		$this->update(['completed' => true]);
		$this->project->recordActivity($this->project, 'completed_task');
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
