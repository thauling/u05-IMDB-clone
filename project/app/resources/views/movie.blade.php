<x-layout>
  <section class="movie-wrapper">
    <h1 class="movie-title">{{ $movie['title'] }}</h1>
    <div class="movie-controls">
      @if (Auth::check())
        @if (in_array($movie['id'], json_decode(Auth::user()->watchlist)))
          <a class="watchlist-link" href="/user/watchlist/remove/{{$movie['id']}}">remove from watchlist</a>
        @else
          <a class="watchlist-link" href="/user/watchlist/add/{{$movie['id']}}">add to watchlist</a>
        @endif
        @if (Auth::check() && Auth::user()->is_admin)
          <a class="edit-link" href="/movies/{{$movie['id']}}/edit">edit movie</a>
        @endif
      @endif
    </div>
    <p class="movie-year">Released <span class="bold-paragraph">{{ $movie['released'] }}</span></p>
    <p class="movie-rating">Rating <span class="bold-paragraph">{{ $movie['avg_rating'] }}/10</span> </p>
    <div class="movie-media">
      <img height="505" src="{{ $movie['urls_images'] }}" alt="movie poster" />
      <iframe width="853" height="505" src="{{ $movie['url_trailer'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <p class="movie-genre">{{ $movie['genre'] }}</p>
    <div class="movie-cast">
      @foreach ($movie['cast'] as $actor)
        <p>{{ $actor }}</p>
      @endforeach
    </div>
    <p class="movie-abstract">{{ $movie['abstract'] }}</p>
  </section>
  <section class="reviews-section">
    <h2>Reviews</h2>
    @if (Auth::check())
      <a href="/reviews/create">Submit a review</a>
    @endif
    @foreach ($reviews as $review)
      <?php $date = date_create($review['created_at']); ?>
      <div class="review-wrapper">
        <h3>{{ $review['user_name'] }}</h3>
        <p>{{ date_format($date, 'Y-m-d') }}</p>
        <p>{{ $review['review_rating'] }}/10</p>
        <p>{{ $review['review_content'] }}</p>
      </div>
    @endforeach
  </section>
</x-layout>