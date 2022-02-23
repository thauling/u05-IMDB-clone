@include('_head')

<?php
    $logo = asset('assets/images/imdb_logo.png');
?>

<body class="bg-gray-300">

    <div class="container mx-auto px-2 py-4">

        <nav class="flex justify-between  md:flex-row items-center">
            
            <img src="{{ $logo }}" alt="IMDb" width="80px">

            <div class="my-2">
                <form action="/search/" method="get">
                    @csrf
                    <input class="rounded border border-solid border-gray-400 py-2 px-2" type="text" placeholder="search" name="s">
                    
                    <button type="submit" class="bg-gray-500 text-white border border-gray-600 hover:bg-blue-300 font-bold py-2 px-4 rounded">search</button>
                </form>
            </div>
            
            @if (Route::has('login'))
                <div class="flex gap-x-2">
                    @auth
                        <div>
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline">{{ Auth::user()->name }}</a>
                        </div>

                        <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout" class="text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline" onclick="this.closest('form').submit(); event.preventDefault();">Logout</a>
                        </form>

                    @else
                        
                        <a href="/login" class="text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>

        <h1 class="text-3xl font-semibold text-gray-900 text-center mt-4">Top 3 movies</h1>

        <?php $i = 0; ?>

            @foreach ($movies as $movie)

            <?php 
            $imgsToArray = json_decode($movie->urls_images); 
                
            $imgPath = "https://image.tmdb.org/t/p/w1280$imgsToArray[0]";
            ?>
                   
                    <article class="max-w-fw mx-auto flex border border-solid border-gray-400 max-h-64 my-5 bg-white rounded ">
                        
                        <div class="w-1/4 border mr-10">
                            <a href="/movies/{{ $movie->id }}">
                        @if ($imgsToArray)
                            <img src=" {{ $imgPath }}" alt="movie comver image" width="100%" height= "auto" class="opacity-30 hover:opacity-100">
                        @else
                            NO IMG
                        @endif
                            </a>
                        </div>

                        <div class="py-10">
                            <a href="/movies/{{ $movie->id }}" class="hover:text-red-700">
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
                            @foreach(json_decode($movie->cast) as $actor)
                                <li>{{ $actor }}</li>
                            @endforeach
                            </ul>
                        </div>
                    </article>

                <?php if(++$i === 3) : ?> 
                    @break
                <?php endif; ?>
            @endforeach


    </div>


     

    



</body>
</html>