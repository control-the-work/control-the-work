<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('event_type_id')->references('id')->on('event_types')->nullable()->comment('References the event type');
            $table->uuid('user_id')->references('id')->on('users')->nullable()->comment('references the user for whom the event is created');
            $table->uuid('creator_user_id')->references('id')->on('users')->nullable()->comment('References the creator of the event');
            $table->boolean('is_start')->default(true)->comment('Show if the event is a start or a finish.');
            $table->string('comments')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('events');
    }
}
