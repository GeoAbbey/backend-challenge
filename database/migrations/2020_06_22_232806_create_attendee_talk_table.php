<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeTalkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_talk', function (Blueprint $table) {
            $table->bigInteger('attendee_id')->unsigned()->index();
            $table->bigInteger('talk_id')->unsigned()->index();

            $table->foreign('attendee_id')->references('id')->on('attendees')->cascadeOnDelete();
            $table->foreign('talk_id')->references('id')->on('talks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendee_talk');
    }
}
