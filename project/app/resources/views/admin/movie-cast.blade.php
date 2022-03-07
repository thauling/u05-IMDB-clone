<?php
if (isset($movie->cast)) {
    $castArr = json_decode($movie->cast, false);
} 
else {
    $castArr = array( 0 => 'Add cast' );
};
?>

<x-admin>
    <section class="flex flex-col items-center">
        @if (session()->has('success'))
        <div class="bg-red-500" x-data="{ show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show">
            <p>{{ session()->get('success') }}</p>
        </div>
        @endif
        <div class="flex flex-col">
            <h1 class="block text-gray-500 text-center font-bold py-5">Find movie by title or abstract</h1>
            <form class=" w-full max-w-sm" method="get" action="{{url('/admin-search-movie')}}">

                @csrf

                <div class="mb-6 flex">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="query">
                            Query
                        </label>
                    </div>
                    <div class="w-full">

                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="query" value="" placeholder="Type something">
                    </div>

                    <div class="md:w-2/3">
                        <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Find
                        </button>
                    </div>
                </div>
                </form>
        </div>
        @if (isset($movie))
        <div class="flex flex-col p-5">
            <h2 class="block text-gray-500 text-center font-bold pb-5">Edit Info about {{$movie->title}}</h2>

            <form class="w-full max-w-sm" action="{{ url('update-movie', $movie->id) }}" method="POST">
                @csrf
                @method('PUT')


                <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="title">Title</label>
                <input type="title" name="title" value="{{ $movie->title }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">

                <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="abstract">Abstract</label>
                <input type="text" name="abstract" value="{{ $movie->abstract }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">

                <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="released">Released</label>
                <input type="released" name="released" value="{{ $movie->released }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">

                <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="genre">Genre</label>
                <input type="text" name="genre" value="{{ $movie->genre }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">

                <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="url_images">Poster URL</label>
                <input type="url_trailer" name="urls_images" value="{{ $movie->urls_images }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">

                <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="url_trailer">Trailer URL</label>
                <input type="url_trailer" name="url_trailer" value="{{ $movie->url_trailer }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">

                <div class="block" id="dynaForm">
                    <label for="cast[0][row]" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Cast</label>
                    <button type="button" id="btnAdd" class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Add row</button>
                    <button type="button" id="btnRemove" class="shadow bg-red-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Remove</button>
                    @foreach($castArr as $key => $cast)
                    <input type="text" name="cast[{{$key}}][row]" value="{{ ($cast) }}" class="newRow bg-gray-200 appearance-none border-2 border-gray-500 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" />
                    @endforeach

                </div>

                <button type="submit" class="shadow bg-green-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Update</button>
            </form>
        </div>


        <!-- JS/Jquery for dynamic form -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            const start = <?php echo (count($castArr) - 1) ?>;
            $(document).ready(function() {
                let i = start;
                $("#btnAdd").click(function() {
                    ++i;
                    $("#dynaForm").append('<div class="block newRow"> <input type="text" name="cast[' + i + '][row]" class="bg-gray-200 border-2 border-gray-500 rounded w-full gap-[2.75rem] py-2 px-4 text-gray-700 focus:outline-none focus:bg-white focus:border-purple-500"/></div>');
                });
                $("#btnRemove").click(function() {
                    $('.newRow:last-child').remove();
                });
            });
        </script>

        @endif

        <div class="shadow bg-yellow-400 text-gray-500 font-bold md:text-left mb-1 md:mb-0 py-2 px-4 rounded"><a href="{{url('admin-main')}}">Back</a></div>
    </section>

</x-admin>