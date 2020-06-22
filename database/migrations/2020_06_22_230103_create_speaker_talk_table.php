<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeakerTalkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speaker_talk', function (Blueprint $table) {
            $table->bigInteger('speaker_id')->unsigned()->index();
            $table->bigInteger('talk_id')->unsigned()->index();

            $table->foreign('speaker_id')->references('id')->on('speakers')->cascadeOnDelete();
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
        Schema::dropIfExists('speaker_talk');
    }
}
