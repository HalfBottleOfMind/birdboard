<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Task;
use App\Project;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
		'project_id' => factory(Project::class),
		'completed' => false		
    ];
});
