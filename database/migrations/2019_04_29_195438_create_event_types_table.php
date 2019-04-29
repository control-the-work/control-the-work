<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_types', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->boolean('is_generic')->default(true)->comment('True if is a type valid for all the companies');
            $table->uuid('company_id')->references('id')->on('companies')->nullable()->comment('References the company if the type is valid only for this company');
            $table->string('name')->nullable();
            $table->boolean('is_work')->default(true)->comment('Show if the event is counted as work.');
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
        Schema::dropIfExists('event_types');
    }
}
