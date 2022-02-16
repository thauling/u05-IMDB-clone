<?php
use App\Models\User;  
use App\Models\Movie;  
use App\Models\Review;  

$usercount = User::count();
$moviecount = Movie::count();
$reviewcount = Review::count();
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
    <p>Row count in users: {{ $usercount }}</p>
    <p>Row count in movies: {{ $moviecount }}</p>
    <p>Row count in reviews: {{ $reviewcount }}</p>
</body>
</html>