<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectownersProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectowners_projects', function (Blueprint $table) {
            $table->integer('project_id')->nullable();
            $table->integer('projectowner_id')->nullable();
            $table->index(['project_id', 'projectowner_id']);
            $table->dateTime('start_date_projectowner')->nullable();
            $table->dateTime('end_date_projectowner')->nullable();
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
        Schema::dropIfExists('projectowners_projects');
    }
}
