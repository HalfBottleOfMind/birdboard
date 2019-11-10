<?php

namespace Tests\Feature;

use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;

class TriggerActivityTest extends TestCase
{
	use RefreshDatabase, WithFaker;

	/** @test */
	public function creating_a_project()
	{
		$this->withoutExceptionHandling();

		$project = ProjectFactory::create();

		$this->assertCount(1, $project->activity);
		$this->assertEquals('created', $project->activity[0]->description);
	}

	/** @test */
	public function updating_a_project()
	{
		$project = ProjectFactory::create();
		$project->update(['title' => 'Changed']);

		$this->assertCount(2, $project->activity);
		$this->assertEquals('updated', $project->activity->last()->description);
	}

	/** @test */
	public function creating_a_new_task()
	{
		$project = ProjectFactory::Create();
		$project->addTask('Some task');

		$this->assertCount(2, $project->activity);

		tap($project->activity->last(), function ($activity) {
			$this->assertEquals('created_task', $activity->description);
			$this->assertInstanceOf(Task::class, $activity->subject);
			$this->assertEquals('Some task', $activity->subject->body);
		});
		
	}

	/** @test */
	public function completing_a_task()
	{
		$project = ProjectFactory::withTasks(1)->Create();
		
		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), [
				'body' => 'foobar',
				'completed' => true
			]);
			
		$this->assertCount(3, $project->activity);
		tap($project->activity->last(), function ($activity) {
			$this->assertEquals('completed_task', $activity->description);
			$this->assertInstanceOf(Task::class, $activity->subject);
		});
	}

	/** @test */
	public function incompleting_a_task()
	{
		$project = ProjectFactory::withTasks(1)->Create();
		
		$this->actingAs($project->owner)
			->patch($project->tasks[0]->path(), [
				'body' => 'foobar',
				'completed' => true
			]);
		$this->patch($project->tasks[0]->path(), [
			'body' => 'foobar'
		]);

		$this->assertCount(4, $project->activity);
		tap($project->activity->last(), function ($activity) {
			$this->assertEquals('incomplete_task', $activity->description);
			$this->assertInstanceOf(Task::class, $activity->subject);
		});
	}

	/** @test */
	public function deleting_a_task()
	{
		$project = ProjectFactory::withTasks(1)->Create();
		$project->tasks[0]->delete();
		$this->assertCount(3, $project->activity);
		$this->assertEquals('deleted_task', $project->activity->last()->description);
	}
}
