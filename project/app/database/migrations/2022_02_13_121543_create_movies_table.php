<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * random comment
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('genre'); // could also be enum:  $table->enum('genre', ['Drama', 'SciFi', 'Action', 'Comedy', 'Horro', 'Western', 'Thriller', 'Documentary', 'etc..'])->default('Pending');
            $table->json('cast')->nullable();;
            $table->text('abstract');
            $table->json('urls_images')->nullable();; //json since >= 1 image(s)
            $table->string('url_trailer'); //we might conside json since movies tend to have > 1 trailers
            $table->decimal('avg_rating', 4, 2)->nullable(); //tot number of digits: 4, of which 2 are decimals, should look up how to do the math automatically 
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
        Schema::dropIfExists('movies');
    }
};
