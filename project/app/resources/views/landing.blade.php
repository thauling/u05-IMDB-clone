@include('_head')

@include('_nav')
        <h1 class="text-3xl font-semibold text-gray-900 text-center mt-4">Top 3 movies</h1>
        <?php $i = 0; ?>

            
            @if(str_contains(url()->current(), '/search-movie'))
                {{ $results->title }}

               <?php
                $movies = $results->attributes;

                print_r($movies);
               ?> 
            @endif
           
                
            @foreach ($movies as $movie)
            
            <?php 
            $imgsToArray = json_decode($movie->urls_images); 
                
            $imgPath = "https://image.tmdb.org/t/p/w1280$imgsToArray[0]";
            ?>
                   
                @include('_movies')

                <?php if(++$i === 3) : ?> 
                    @break
                <?php endif; ?>
            @endforeach

    </div>


</body>
</html>