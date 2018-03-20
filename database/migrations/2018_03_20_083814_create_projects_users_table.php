<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_users', function (Blueprint $table) {
            $table->integer('project_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->index(['project_id', 'user_id']);
            $table->boolean('projectowner')->default(false);
            $table->dateTime('start_date_user')->default(now());
            $table->dateTime('end_date_user')->nullable();
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
        Schema::dropIfExists('projects_users');
    }
}
