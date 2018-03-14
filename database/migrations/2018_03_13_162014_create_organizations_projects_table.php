<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations_projects', function (Blueprint $table) {
            $table->integer('organization_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->index(['organization_id', 'project_id']);
            $table->dateTime('start_date_organization');
            $table->dateTime('end_date_organization');
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
        Schema::dropIfExists('organizations_projects');
    }
}
