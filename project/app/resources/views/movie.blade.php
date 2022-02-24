<x-layout>
  <section class="movie-wrapper">
    <h1 class="movie-title">{{ $movie['title'] }}</h1>
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
  <section class="reviews-wrapper">
    <h2>Reviews</h2>
    <a href="/reviews/create">Submit a review</a>
    @foreach ($reviews as $review)
      <?php $date = date_create($review['created_at']); ?>
      <div>
        <h3>{{ $review['user_name'] }}</h3>
        <p>{{ date_format($date, 'Y-m-d') }}</p>
        <p>{{ $review['review_rating'] }}/10</p>
        <p>{{ $review['review_content'] }}</p>
      </div>
    @endforeach
  </section>
</x-layout>