<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Task;

class Project extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
	}
	
	public function addTask($body)
	{
		return $this->tasks()->create(compact('body'));
	}

	public function tasks()
	{
		return $this->hasMany(Task::class);
	}

	public function activity()
	{
		return $this->hasMany(Activity::class);
	}

	public function recordActivity($description)
	{
		$this->activity()->create(compact('description'));
	}
}
