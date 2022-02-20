<?php 
  $imgsToArray = json_decode($movie->urls_images); 
  
  $imgPath = "https://image.tmdb.org/t/p/w1280$imgsToArray[0]";
?>

<x-layout>
  <h1>{{ $movie->title }}</h1>
  <p>{{ $movie->released }}</p>
  <p>{{ $movie->avg_rating }}</p>
  <img height="505" src="{{ $imgPath }}" alt="movie poster" />
  <iframe width="853" height="505" src="{{ $movie->url_trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <p>{{ $movie->genre }}</p>
  @foreach (json_decode($movie->cast) as $actor)
    <p>{{ $actor }}</p>
  @endforeach
  <p>{{ $movie->abstract }}</p>
</x-layout>