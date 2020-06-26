<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conference_id')->unsigned()->index();
            $table->string('title');
            $table->string('address');
            $table->date('talk_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->text('description');
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('talks');
    }
}
