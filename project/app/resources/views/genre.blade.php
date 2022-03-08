<!DOCTYPE html>
<html lang="en">
    @include('_head')
    <body class="bg-gray-300">

        <div class="container block mx-auto px-2 py-4">
            @include('_nav')
            <h1 class="text-3xl font-semibold text-gray-900 text-center mt-4">
                @isset($results)
                    Results
                @else
                    {{ ucfirst($genre) }}
                @endif
            </h1>
            <?php $i = 0; ?>

                
                @if(str_contains(url()->current(), '/search-movie'))

                <?php
                    $movies = $results;
                   
                ?> 
                @endif
            
                    
                @foreach ($movies as $movie)
                
                <?php 
                $imgsToArray = json_decode($movie->urls_images); 
                    
                $imgPath = $imgsToArray[0];
                ?>
                    
                    @include('_movies')

                @endforeach

        </div>


    </body>
</html>