<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Reviews</title>
</head>
<body>

<form action="{{url('store-review')}}" method="post">
@csrf 
<label for="content">Content</label>
<input type="text" id="content"name="content" value="">
<label for="rating">Rating (1-5)</label>
<input type="number" id="rating" name="rating" min="1" max="5">
<label for="user_id">User</label>
<input type="number" id="user_id" name="user_id">
<label for="movie_id">Movie</label>
<input type="number" id="movie_id" name="movie_id">
<button type="submit">Submit</button>
</form>
@if(session('status'))
    <div >
        {{ session('status') }}
    </div>
@endif

<br><br><br>



@if (count($reviews))
    <p>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-100 border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    User_id
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Content
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Rating
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Movie_id
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$review->user_id}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$review->review_content}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$review->review_rating}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$review->movie_id}}
                                </td>
                                <td>
                                    <a href="{{ url('edit-review/'.$review->id) }}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </p>
    @else
    <p>
        No users found.
    </p>
    @endif

</body>
</html>