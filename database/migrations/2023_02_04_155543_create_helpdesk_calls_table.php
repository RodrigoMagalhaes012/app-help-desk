<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdeskCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpdesk_calls', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('description');
            $table->enum('status', ['Open', 'In Progress', 'Overdue', 'Resolved']);
            $table->unsignedBigInteger('user_id_agent');
            $table->unsignedBigInteger('user_id_client');
            $table->foreign('user_id_agent')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_client')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('helpdesk_calls');
    }
}
