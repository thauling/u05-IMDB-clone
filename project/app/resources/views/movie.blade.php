<?php 
  $imgsToArray = json_decode($movie->urls_images); 
  
  $imgPath = "https://image.tmdb.org/t/p/w1280$imgsToArray[0]";
?>

<x-layout>
  <section class="movie-wrapper">
    <h1 class="movie-title">{{ $movie->title }}</h1>
    <p class="movie-year">Released <span class="bold-paragraph">{{ $movie->released }}</span></p>
    <p class="movie-rating">Rating <span class="bold-paragraph">{{ $movie->avg_rating }}/10</span> </p>
    <div class="movie-media">
      <img height="505" src="{{ $imgPath }}" alt="movie poster" />
      <iframe width="853" height="505" src="{{ $movie->url_trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <p class="movie-genre">{{ $movie->genre }}</p>
    <div class="movie-cast">
      @foreach (json_decode($movie->cast) as $actor)
        <p>{{ $actor }}</p>
      @endforeach
    </div>
    <p class="movie-abstract">{{ $movie->abstract }}</p>
  </section>
</x-layout>