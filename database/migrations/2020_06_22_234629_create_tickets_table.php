<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number');
            $table->bigInteger('attendee_id')->unsigned()->index();
            $table->bigInteger('conference_id')->unsigned()->index();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('attendee_id')->references('id')->on('attendees')->cascadeOnDelete();
            $table->foreign('conference_id')->references('id')->on('conferences')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
