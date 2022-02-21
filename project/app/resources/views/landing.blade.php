<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    
</head>
<body class="bg-orange-300">

    <div class="container mx-auto px-2 py-4">
        <div class="flex justify-between flex-col md:flex-row">
            <div class="my-2">
                <input class="rounded py-2 px-2" type="text" placeholder="search">
                <button class="bg-blue-500 text-white hover:bg-blue-400 font-bold py-2 px-4 rounded">search</button>
            </div>

            <div class="my-2">
                <button class="bg-blue-500 text-white hover:bg-blue-400 font-bold py-2 px-4 rounded">Profile</button>
                <button class="bg-blue-500 text-white hover:bg-blue-400 font-bold py-2 px-4 rounded">Button</button>
                <button class="bg-blue-500 text-white hover:bg-blue-400 font-bold py-2 px-4 rounded">Button</button>
            </div>

        </div>

            @foreach ($movies as $movie)           
                <article class="max-w-fw mx-auto flex border max-h-64 my-5 bg-white rounded ">
                    
                    <div class="w-1/4 border mr-10">
                    @if ($movie->urls_images)
                        <img src=" {{ $movie->urls_images[0] }}" alt="movie comver image" width="100%" height= "auto">
                    @else
                    NO IMG
                    @endif
                    </div>

                    <div class="py-10">
                        <h2 class="text-lg font-bold block">
                            {{ $movie->title }}
                        </h2>

                        <p class="block">
                        {{ $movie->genre }}
                        </p>
                        
                        
    
                    </div>

                    <div class="ml-10 py-10">
                        <h3 class="font-bold">Cast</h3>
                        <ul>
                        @foreach($movie->cast as $actor)
                            <li>{{ $actor }}</li>
                        @endforeach
                        </ul>
                    </div>
                </article>
        @endforeach


    </div>


     

    



</body>
</html>