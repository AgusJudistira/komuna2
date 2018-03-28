<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id')->nullable();
            $table->integer('recipient_id')->nullable();
            $table->integer('project_id')->default(0);
            $table->integer('organization_id')->default(0);
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->text('user_message')->nullable();
            $table->text('actions')->nullable();
            $table->boolean('action_taken')->nullable(); // 0 = undecided, 1 = accepted, 2 = refused
            $table->boolean('is_read')->default(false);
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
        Schema::table('messages', function (Blueprint $table) {
            //
        });
    }
}
