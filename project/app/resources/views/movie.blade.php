<?php 
  $imgsToArray = json_decode($movie->urls_images); 
  
  $imgPath = "https://image.tmdb.org/t/p/w1280$imgsToArray[0]";
?>

<x-layout>
  <h1>{{ $movie->title }}</h1>
  <p>{{ $movie->released }}</p>
  <p>{{ $movie->genre }}</p>
  <p>{{ $movie->avg_rating }}</p>
  <img width="280" src="{{ $imgPath }}" alt="movie poster" />
  <iframe width="560" height="315" src="{{ $movie->url_trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  @foreach (json_decode($movie->cast) as $actor)
    <p>{{ $actor }}</p>
  @endforeach
  <p>{{ $movie->abstract }}</p>
</x-layout>