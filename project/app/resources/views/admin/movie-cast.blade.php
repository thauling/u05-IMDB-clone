<?php
// temp code, currently not used
// $rownumber = 0;
// $collect = []; // empty array for collect customised inputs

// foreach ($request->all() as $input_key => $input_value) { // split input one by one

//     $collect[] = array( //customised inputs
//         "id" => $input_key,
//         "value" => $input_value

//     );
// }

// $result = json_encode($collect); //convert to json
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

    <form action="{{ url('update-movie', $movie->id) }}" method="POST">
        @csrf
        @method('PUT')


        <label for="title">Title</label>
        <input type="title" name="title" value="{{ $movie->title }}" class="" placeholder="">
        <label for="abstract">Email</label>
        <input type="text" name="abstract" value="{{ $movie->abstract }}" class="" placeholder="">
        <label for="genre">Genre</label>
        <input type="text" name="genre" value="{{ $movie->genre }}" class="" placeholder="">

        <button type="submit" class="">Update</button>
    </form>

    <h2>Edit cast of a movie</h2>

    <form method="post" action="{{url('update-movie', $movie->id)}}">
        @csrf
        @method('PUT')

        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <label for="cast1">Cast1</label>
        <input type="text" name="cast1" value="" class="" placeholder="" />
        <button type="submit">Submit</button>
    </form>

    @endif
</x-admin>