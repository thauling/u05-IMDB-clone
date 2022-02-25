<?php

use App\Models\Movie;

if (isset($_GET['dynaInput'])) {
    //print_r($_GET['dynaInput']);
    $id = $_GET['movie_id'];
    $cast = [];
    //DB::table('movies')->where('id', $id)->update(['cast' => json_encode(array('Mr T', 'Jack', 'Gina'))]);
    //DB::table('movies')->where('id', $id)->update(['cast' => json_encode(array(array_values($_GET)))]); //this works
    for ($i = 0; $i < count($_GET['dynaInput']); $i++) {
        $cast[] = array_values($_GET['dynaInput'][$i]);
    };
    $flattened_cast = array_reduce($cast, 'array_merge', []);
    Movie::where('id', $id)->update(['cast' => json_encode(array_values($flattened_cast))]);
};
?>

<x-admin>

    <h2>Find movie by title or abstract (should add cast)</h2>
    <form class="w-full max-w-sm" method="get" action="{{url('search-movie')}}">
        <!-- need to fix this -->
        @csrf
        <!-- <div class="md:flex md:items-center mb-6"> -->
        <div class="mb-6 flex">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="query">
                    Query
                </label>
            </div>
            <div class="w-full">
                <!-- md:w-2/3 -->
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="query" value="" placeholder="Type something">
            </div>

            <div class="md:w-2/3">
                <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    Find
                </button>
            </div>
        </div>
    </form>

    @if (isset($movie))

    <h2>Edit User</h2>

    <form class="w-full max-w-sm" action="{{ url('update-movie', $movie->id) }}" method="POST">
        @csrf
        @method('PUT')


        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="title">Title</label>
        <input type="title" name="title" value="{{ $movie->title }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">
        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="abstract">Abstract</label>
        <input type="text" name="abstract" value="{{ $movie->abstract }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">
        <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="genre">Genre</label>
        <input type="text" name="genre" value="{{ $movie->genre }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">

        <button type="submit" class="">Update</button>
    </form>

    @if ( isset($movie->id) && isset($movie->title)):
    <h2>Edit cast of {{$movie->title}}</h2>
    <div class="">
        <form class="w-full max-w-sm" method="get" action="">
            @csrf
            <input type="hidden" name="movie_id" value="{{ $movie->id }}" class="" placeholder="">
            <div class="block" id="dynaForm">
                <label for="dynaInput[0][row]" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Cast</label>
                <input type="text" name="dynaInput[0][row]" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                <button type="button" id="addRow" class="">Add</button>
            </div>
            <div class="">
                <button type="submit" class="">Submit</button>
            </div>
        </form>
    </div>

    <div  class="black text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4"><a href="{{url('admin-main')}}">Back</a></div>

<!-- JS/Jquery for dynamic form -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        let i = 0;
        $("#addRow").click(function() {
            ++i;
            $("#dynaForm").append('<div class="block"><input type="text" name="dynaInput[' + i + '][row]" class="bg-gray-200 border-2 border-gray-500 rounded w-full gap-[2.75rem] py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500"/> </div>');
        });
    </script>
    @endif
    <!-- <form method="post" action="">          
    @csrf

        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <button type="submit">Submit</button>
    </form> -->

    @endif
</x-admin>