<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
     @foreach ($movies as $movie)        
        <article>
            <h2 class="text-lg font-bold">
                {{ $movie->title }}
            </h2>

            <h3>Genre</h3>

            <p>
            {{ $movie->genre }}
            </p>
            
            <h3>Cast</h3>
            
            

            <ul>
            @foreach($movie->cast as $actor)
                <li>{{ $actor }}</li>
            @endforeach
            </ul>
        </article>
        <hr/>
    @endforeach
</body>
</html>