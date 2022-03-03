
@include('_head')


<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/app.css">

</head>
@if (session('status'))
                <h6>{{ session('status') }}</h6>
@endif
<form action="{{url('update-review', $review->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                  <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                      <div class="col-span-3 sm:col-span-2">
                          <h4>{{$movie->title}}</h4>
                        <fieldset>
                          <span class="star-cb-group">
                            <input id="rating-10" type="radio" name="movie_rating" value="10" /><label for="rating-10">10</label>
                            <input id="rating-9" type="radio" name="movie_rating" value="9" /><label for="rating-9">9</label>
                            <input id="rating-8" type="radio" name="movie_rating" value="8" /><label for="rating-8">8</label>
                            <input id="rating-7" type="radio" name="movie_rating" value="7" /><label for="rating-7">7</label>
                            <input id="rating-6" type="radio" name="movie_rating" value="6" /><label for="rating-6">6</label>
                            <input id="rating-5" type="radio" name="movie_rating" value="5" /><label for="rating-5">5</label>
                            <input id="rating-4" type="radio" name="movie_rating" value="4" /><label for="rating-4">4</label>
                            <input id="rating-3" type="radio" name="movie_rating" value="3" /><label for="rating-3">3</label>
                            <input id="rating-2" type="radio" name="movie_rating" value="2" /><label for="rating-2">2</label>
                            <input id="rating-1" type="radio" name="movie_rating" value="1" /><label for="rating-1">1</label>
                          </span>
                        </fieldset>
                        <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full px-3">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="title">Title</label>
                            <input value="{{$review->title}}"class="appearance-none block w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="title" name="title">
                          </div>
                        </div>
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" >Content</label>
                        <div class="mt-1">
                          <input type="text" id="content" name="content" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$review->review_content}}">
                          <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                          <input type="hidden" id="movie_id" name="movie_id" value="{{$review->movie_id}}">
                          <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Update</button>
                          </div>
              </form>
