<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalkAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talk_assets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('talk_id')->unsigned()->index();
            $table->text('asset_url');
            $table->timestamps();

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
        Schema::dropIfExists('talk_assets');
    }
}
