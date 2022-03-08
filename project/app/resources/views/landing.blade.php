<!DOCTYPE html>
<html lang="en">
@include('_head')

<body class="bg-gray-300 font-sans antialiased">

    <div class="container block mx-auto px-2 py-4">
        @include('_nav')
        <h1 class="text-3xl font-semibold text-gray-900 text-center mt-4">
            @isset($results)
            Results
            @else
            Top 3 movies
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

        @if(!str_contains(url()->current(), '/search-movie'))
        <?php if (++$i === 3) : ?>
            @break
        <?php endif;
        ?>
        @endif
        @endforeach

        @if (!str_contains(url()->current(), '/search-movie'))
        <h2 class="text-3xl font-semibold text-gray-900 text-center my-6">Browse by category</h2>

        <?php
        $actions = [];
        $horrors = [];
        $animations = [];
        $fantasies = [];
        $animations = [];
        $i = 0;

        foreach ($movies as $movie) {
            if ($movie->genre === 'Action') {
                array_push($actions, $movie);
            } elseif ($movie->genre === 'Horror') {
                array_push($horrors, $movie);
            } elseif ($movie->genre === 'animation') {
                array_push($animations, $movie);
            } elseif ($movie->genre === 'animation') {
                array_push($fantasies, $movie);
            } elseif ($movie->genre === 'Animation') {
                array_push($animations, $movie);
            }
        }
        ?>


        <!-- ACTIONS -->
        <a href="{{ url('movies/genre/action') }}">
            <article class="max-w-fw mx-auto flex justify-center border-solid border-2 border-white max-h-full my-5 bg-white rounded relative before:bg-black before:w-full before: h-full before:z-10 before:absolute before:inset-0 before:opacity-50 hover:before:opacity-40">
                <h3 class="text-3xl font-semibold text-white absolute self-center z-20">Action</h3>
                @foreach ($actions as $action)

                <?php
                $imgsToArray = json_decode($action->urls_images);
                $imgPath = $imgsToArray[0];

                ?>

                <div class="w-1/3 h-full border">

                    @if ($action->urls_images)
                    <img src=" {{ $imgPath }}" alt="movie comver image" width="100%" height="auto" class="opacity-80">
                    @else
                    NO IMG
                    @endif
                </div>

                <?php if (++$i === 3) : ?>
                    @break
                <?php endif; ?>
                @endforeach
            </article>
        </a>

        <?php
        $i = 0;
        ?>

        <!-- HORRORS -->

        <a href="{{ url('movies/genre/horror') }}">
            <article class="max-w-fw mx-auto flex justify-center border-solid border-2 border-white max-h-full my-5 bg-white rounded relative before:bg-black before:w-full before: h-full before:z-10 before:absolute before:inset-0 before:opacity-50 hover:before:opacity-40">
                <h3 class="text-3xl font-semibold text-white absolute self-center z-20">Horror</h3>
                @foreach ($horrors as $horror)

                <?php
                $imgsToArray = json_decode($horror->urls_images);
                $imgPath = $imgsToArray[0];

                ?>

                <div class="w-1/3 h-full border">

                    @if ($horror->urls_images)
                    <img src=" {{ $imgPath }}" alt="movie comver image" width="100%" height="auto" class="opacity-80">
                    @else
                    NO IMG
                    @endif
                </div>

                <?php if (++$i === 3) : ?>
                    @break
                <?php endif; ?>
                @endforeach
            </article>
        </a>


        <!-- ANIMATION -->
        <?php
        $i = 0;
        ?>

        <a href="{{ url('movies/genre/animation') }}">
            <article class="max-w-fw mx-auto flex justify-center border-solid border-2 border-white max-h-full my-5 bg-white rounded relative before:bg-black before:w-full before: h-full before:z-10 before:absolute before:inset-0 before:opacity-50 hover:before:opacity-40">
                <h3 class="text-3xl font-semibold text-white absolute self-center z-20">Animated</h3>
                @foreach ($animations as $animation)

                <?php
                $imgsToArray = json_decode($animation->urls_images);
                $imgPath = $imgsToArray[0];

                ?>

                <div class="w-1/3 h-full border">

                    @if ($animation->urls_images)
                    <img src=" {{ $imgPath }}" alt="movie comver image" width="100%" height="auto" class="opacity-80">
                    @else
                    NO IMG
                    @endif
                </div>

                <?php if (++$i === 3) : ?>
                    @break
                <?php endif; ?>
                @endforeach
            </article>
        </a>
        @endif
    </div>


</body>

</html>