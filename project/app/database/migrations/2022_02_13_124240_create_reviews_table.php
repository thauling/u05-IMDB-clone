<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('review_content')->nullable();
            $table->tinyInteger('review_rating')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            //$table->foreignId('user_id')->constrained('users'); //ought to work as of L8
            $table->foreignId('user_id');
            $table->foreignId('movie_id');
            //$table->foreignId('movie_id')->constrained('movies'); //supposedly this auto-assumes 'id' in movies table 
            //$table->integer('user_id')->unsigned(); // from Sebbe's example 
            //$table->integer('movie_id')->unsigned(); 
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
        Schema::dropIfExists('reviews');
    }
};
