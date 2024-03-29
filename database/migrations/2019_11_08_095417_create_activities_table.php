<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->bigInteger('project_id')->index()->unsigned();
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->bigInteger('user_id')->index()->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->nullableMorphs('subject');
            $table->string('description');
            $table->text('changes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
