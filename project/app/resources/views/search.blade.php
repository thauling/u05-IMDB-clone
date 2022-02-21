@include('_head')


<body class="bg-gray-800">

    <div class="container mx-auto px-2 py-4">

        <nav class="flex justify-between flex-col md:flex-row">
            
            <a href="/">
                <h1 class="text-4xl font-bold text-blue-600">iMDB</h1>
            </a>

            <div class="my-2">
                <form action="/search/" method="get">
                    <input class="rounded py-2 px-2" type="text" placeholder="search" name="s">
                    
                    <button type="submit" class="bg-blue-500 text-white hover:bg-blue-400 font-bold py-2 px-4 rounded">search</button>
                </form>
            </div>

            <div class="my-2">
                <button class="bg-blue-500 text-white hover:bg-blue-400 font-bold py-2 px-4 rounded">Profile</button>
                
            </div>
        </nav>

        <h1 class="text-3xl font-semibold text-white text-center mt-4">Result</h1>
 
        <?php 
        $random_first = rand(0, (count($movies) - 3));
        $movie_set = array_slice($movies->toArray(), $random_first, 3);

        ?>

        <?php $i = 0; ?>

            @foreach ($movies as $movie)
                @if (Str::contains(strtolower($movie->title), $_GET['s']))       
                    <article class="max-w-fw mx-auto flex border max-h-64 my-5 bg-white rounded ">
                        
                        <div class="w-1/4 border mr-10">
                            <a href="/movie/{{ $movie->id }}">
                        @if ($movie->urls_images)
                            <img src=" {{ $movie->urls_images[0] }}" alt="movie comver image" width="100%" height= "auto" class="opacity-30 hover:opacity-100">
                        @else
                            NO IMG
                        @endif
                            </a>
                        </div>

                        <div class="py-10">
                            <a href="/movie/{{ $movie->id }}" class="hover:text-red-700">
                                <h2 class="text-lg font-bold block">
                                    {{ $movie->title }}
                                </h2>
                            </a>

                            <p class="block">
                            {{ $movie->genre }}
                            </p>
                            
                            
        
                        </div>

                        <div class="ml-10 pt-10">
                            <h3 class="font-bold">Cast</h3>
                            <ul class="text-sm sm:text-base">
                            @foreach($movie->cast as $actor)
                                <li>{{ $actor }}</li>
                            @endforeach
                            </ul>
                        </div>
                    </article>
                @endif
            @endforeach


    </div>
     

</body>
</html>