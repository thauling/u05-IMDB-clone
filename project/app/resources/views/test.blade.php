<?php
//for testing, this should all go into respective controllers and then passed on to .blade via web.php
use App\Models\User;  
use App\Models\Movie;  
use App\Models\Review;  

//$usercount = User::count();
// $moviecount = Movie::count();
// $reviewcount = Review::count();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Shiny new IMDB</h1>
    @if (User::count())
    <p>Row count in users: {{ User::count() }}</p>
    @endif
    @if (Movie::count())
    <p>Row count in movies: {{ Movie::count() }}</p>
    @endif
    @if (Review::count())
    <p>Row count in reviews: {{ Movie::count() }}</p>
    @endif
</body>
</html>