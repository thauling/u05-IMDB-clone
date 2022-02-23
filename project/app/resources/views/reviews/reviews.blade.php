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
<div class="mt-5 md:mt-0 md:col-span-2">
    <form action="{{url('store-review')}}" method="post">
    @csrf 
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Content</label>
                            <div class="mt-1">
                            <input type="text" id="content"name="content" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="">
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
    @foreach ($reviews as $review)
    <div class="mb-2 shadow-lg rounded-t-8xl rounded-b-5xl overflow-hidden">
      <div class="pt-3 pb-3 md:pb-1 px-4 md:px-16 bg-white bg-opacity-40">
        <div class="flex flex-wrap items-center">
          <img class="mr-6" src="uinel-assets/images/ecommerce-reviews/user.png" alt="">
          <h4 class="w-full md:w-auto text-xl font-heading font-medium">{{$review->user_id}}</h4>
          <div class="w-full md:w-px h-2 md:h-8 mx-8 bg-transparent md:bg-gray-200"></div>
          <div class="inline-flex">
              @for ($i = 0; $i < $review->review_rating; $i++)
            <a class="inline-block mr-1" href="#">
              <svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 7.91677H12.4167L10 0.416763L7.58333 7.91677H0L6.18335 12.3168L3.81668 19.5834L10 15.0834L16.1834 19.5834L13.8167 12.3168L20 7.91677Z" fill="#FFCB00"></path>
              </svg>
            </a>
            @endfor
          </div>
        </div>
      </div>
      <div class="px-4 overflow-hidden md:px-16 pt-8 pb-12 bg-white">
        <div class="flex flex-wrap">
          <div class="w-full md:w-2/3 mb-6 md:mb-0">
            <p class="mb-8 max-w-2xl text-darkBlueGray-400 leading-loose">{{$review->review_content}}</p>
            <div class="-mb-2">
            </div>
          </div>
          <div class="w-full md:w-1/3 text-right">
            <p class="mb-8 text-sm text-gray-300">Created at {{$review->created_at}}</p>
          </div>
        </div>
      </div>
    </div>
    <br>
    @endforeach
@endif
</body>
</html>