<?php 
  $imgsToArray = json_decode($movie->urls_images); 
  
  $imgPath = asset('assets/images/' . $imgsToArray[0]);
?>

<x-layout>
    <h1>{{ $movie->title }}</h1>
    <p>{{ $movie->released }}</p>
    <img width="560" src="{{ $imgPath }}" alt="movie poster" />
    <iframe width="560" height="315" src="{{ $movie->url_trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    @foreach (json_decode($movie->cast) as $actor)
    <p>{{ $actor }}</p>

    @endforeach
</x-layout>