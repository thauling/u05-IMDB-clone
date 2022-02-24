@include('_head')

@include('_nav')

        <h1 class="text-3xl font-semibold text-gray-900 text-center mt-4">Result</h1>

        <?php 
        $actors = [];
        ?>


            @foreach ($movies as $movie)

            <?php 
            $imgsToArray = json_decode($movie->urls_images); 
                
            $imgPath = "https://image.tmdb.org/t/p/w1280$imgsToArray[0]";
            ?>

                @foreach (json_decode($movie->cast) as $actor)
                   
                    @if (Str::contains(strtolower($actor), strtolower($_GET['s'])))
                        <?php
                        array_push($actors, $actor);
                        ?>
                    @endif
                   
                @endforeach

                @if (Str::contains(strtolower($movie->title), strtolower($_GET['s'])) || 
                Str::contains(strtolower($movie->genre), strtolower($_GET['s'])) || !empty($actors))  
                
                    @include('_movies')

                @endif
                <?php
                $actors = [];
                ?>
            @endforeach
    </div>
</body>
</html>