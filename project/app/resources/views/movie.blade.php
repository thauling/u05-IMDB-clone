

  </section>
<!DOCTYPE html>
<html lang="en">
  @include('_temp-head')
  <body class="bg-gray-300">
    <div class="container mx-auto px-2 py-4">
      @include('_nav')
      <section class="movie-wrapper">
        <h1 class="movie-title">{{ $movie['title'] }}</h1>
        <div class="movie-controls">
          @if (Auth::check())
            @if (!json_decode(Auth::user()->watchlist) || !in_array($movie['id'], json_decode(Auth::user()->watchlist)))
              <a class="watchlist-link" href="/user/watchlist/add/{{$movie['id']}}">add to watchlist</a>
            @elseif (in_array($movie['id'], json_decode(Auth::user()->watchlist)))
              <a class="watchlist-link" href="/user/watchlist/remove/{{$movie['id']}}">remove from watchlist</a>
            @endif
            @if (Auth::check() && Auth::user()->is_admin)
              <a class="edit-link" href="/movies/{{$movie['id']}}/edit">edit movie</a>
            @endif
          @endif
        </div>
        <p class="movie-year">Released <span class="bold-paragraph">{{ $movie['released'] }}</span></p>
        <p class="movie-rating">Rating <span class="bold-paragraph">{{ $movie['avg_rating'] }}/10</span> </p>
        <div class="movie-media container_2">
          <img class="movie_poster" height="505" src="{{ $movie['urls_images'] }}" alt="movie poster" />
          <iframe width="853" height="505" class="movie_trailer" src="{{ $movie['url_trailer'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p class="movie-genre">{{ $movie['genre'] }}</p>
        <div class="movie-cast">
          @foreach ($movie['cast'] as $actor)
          <p>{{ $actor }}</p>
          @endforeach
        </div>
        <p class="movie-abstract">{{ $movie['abstract'] }}</p>
      </section>
    @include('_reviews')
    </div>
  </body>
</html>
