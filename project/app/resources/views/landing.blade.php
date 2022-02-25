@include('_head')

@include('_nav')
        <h1 class="text-3xl font-semibold text-gray-900 text-center mt-4">Top 3 movies</h1>
        <?php $i = 0; ?>

            
            @if(str_contains(url()->current(), '/search-movie'))

               <?php
                $movies = $results;
                // @dd($movies);
                // print_r($movies);
               ?> 
            @endif
           
                
            @foreach ($movies as $movie)
            
            <?php 
            $imgsToArray = json_decode($movie->urls_images); 
                
            $imgPath = "https://image.tmdb.org/t/p/w1280$imgsToArray[0]";
            ?>
                   
                @include('_movies')

                @if(!str_contains(url()->current(), '/search-movie'))
                <?php if(++$i === 3) : ?> 
                    @break
                <?php endif; ?>
                @endif
            @endforeach

    </div>


</body>
</html>