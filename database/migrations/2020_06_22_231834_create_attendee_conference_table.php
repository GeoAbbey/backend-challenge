<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeConferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_conference', function (Blueprint $table) {
            $table->bigInteger('attendee_id')->unsigned()->index();
            $table->bigInteger('conference_id')->unsigned()->index();

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
        Schema::dropIfExists('attendee_conference');
    }
}
