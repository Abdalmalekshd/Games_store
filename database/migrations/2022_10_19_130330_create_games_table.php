<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('game_name_ar');
            $table->string('game_name_en');
            $table->string('game_details_ar');
            $table->string('game_details_en');
            $table->string('photo');
            $table->string('rating')->default(0);
            $table->string('game_category_ar');
            $table->string('game_category_en');
            $table->string('link');
            $table->integer('admin_id')->unsigned()->nullable();
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
        Schema::dropIfExists('games');
    }
}
