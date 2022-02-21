<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Movie: {{ $review->id }}</h1>

<div>
    <p>
        <strong>Content:</strong> {{ $review->review_content }}<br>
        <strong>Rating:</strong> {{ $review->review_rating }}<br>
        <strong>User:</strong> {{ $review->user_id }}<br>

    </p>
</div>
</body>
</html>