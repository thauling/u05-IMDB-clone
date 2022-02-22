<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if (session('status'))
                <h6>{{ session('status') }}</h6>
@endif
<div >
        <form action="{{url('update-review/'. $review->id)}}" method="POST">
            @csrf
            @method('PUT')
            <label for="content">Content</label>
        <input type="text" id="content"name="content" value="{{$review->review_content}}">
        <label for="rating">Rating (1-5)</label>
        <input type="number" id="rating" name="rating" min="1" max="5" value="{{$review->review_rating}}">
        <label for="user_id">User</label>
        <input type="number" id="user_id" name="user_id" value="{{$review->user_id}}">
        <label for="movie_id">Movie</label>
        <input type="number" id="movie_id" name="movie_id" value="{{$review->movie_id}}">
        <button type="submit">Update Review</button>
</form>
</body>
</html>