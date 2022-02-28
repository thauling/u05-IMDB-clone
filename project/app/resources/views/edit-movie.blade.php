<!-- Should only be accessed by admin -->
<?php 
  $castToString = implode(",", $movie['cast']);
?>


<x-layout>
  <section class="">
    <h1>Update movie</h1>
    <form class="edit-movie-form" action="{{url('movies/' . $movie['id'] . '/update')}}" method="POST">
      <label id="title" for="title">Title</label>
      <input type="text" name="title" value="{{ $movie['title'] }}">

      <label id="released" for="released">Released</label>
      <input type="number" name="released" min="1900" max="2099" value="{{ $movie['released'] }}">

      <label id="genre" for="genre">Genre</label>
      <input type="text" name="genre" value="{{ $movie['genre'] }}">

      <label id="abstract" for="abstract">Abstract</label>
      <input type="text" name="abstract" value="{{ $movie['abstract'] }}">

      <label id="url_trailer" for="url_trailer">Trailer url</label>
      <input type="text" name="url_trailer" value="{{ $movie['url_trailer'] }}">

      <label id="cast" for="cast">Cast</label>
      <input type="text" name="cast" value="{{ $castToString }}">

      <button type="submit">Update movie</button>
    </form>
  </section>
</x-layout>