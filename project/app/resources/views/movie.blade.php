<x-layout>
  <section class="movie-wrapper">
    <h1 class="movie-title">{{ $movie['title'] }}</h1>
    <div class="movie-controls">
      @if (Auth::check())
      @if (!json_decode(Auth::user()->watchlist))
      <a class="watchlist-link" href="/user/watchlist/add/{{$movie['id']}}">add to watchlist</a>
      @elseif (in_array($movie['id'], json_decode(Auth::user()->watchlist)))
      <a class="watchlist-link" href="/user/watchlist/remove/{{$movie['id']}}">remove from watchlist</a>
      @else
      <a class="watchlist-link" href="/user/watchlist/add/{{$movie['id']}}">add to watchlist</a>
      @endif
      @if (Auth::check() && Auth::user()->is_admin)
      <a class="edit-link" href="/movies/{{$movie['id']}}/edit">edit movie</a>
      @endif
      @endif
    </div>
    <p class="movie-year">Released <span class="bold-paragraph">{{ $movie['released'] }}</span></p>
    <p class="movie-rating">Rating <span class="bold-paragraph">{{ $movie['avg_rating'] }}/10</span> </p>
    <div class="movie-media container_2">
      <img class="movie_poster" height="505" src="{{ $movie['urls_images'] }}" alt="movie poster" />
      <iframe width="853" height="505" class="movie_trailer" src="{{ $movie['url_trailer'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <p class="movie-genre">{{ $movie['genre'] }}</p>
    <div class="movie-cast">
      @foreach ($movie['cast'] as $actor)
      <p>{{ $actor }}</p>
      @endforeach
    </div>
    <p class="movie-abstract">{{ $movie['abstract'] }}</p>
  </section>
  <section class="reviews-section">
    <h2>Reviews</h2>
    @if(Auth::check())
    <button type="button" class="px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Rate this movie
</button>
    @endif
    @if (session('status'))
    <h6>{{ session('status') }}</h6>
    @endif

    @foreach ($reviews as $review)
    <?php $date = date_create($review['created_at']); ?>
    <!-- <div class="review-wrapper"> -->
    <div class="mb-2 shadow-lg rounded-t-8xl rounded-b-5xl overflow-hidden">
      <div class="pt-3 pb-3 md:pb-1 px-4 md:px-16 bg-white bg-opacity-40">
        <div class="flex flex-wrap items-center">
          <h3 class="w-full md:w-auto text-xl font-heading font-medium">{{ $review['user_name'] }}</h3>
          <p class="mb-8 text-sm text-gray-300">{{ date_format($date, 'Y-m-d') }}</p>
          <div class="w-full md:w-px h-2 md:h-8 mx-8 bg-transparent md:bg-gray-200"></div>
          <div class="inline-flex">
            @for ($i = 0; $i < $review['review_rating']; $i++) <a class="inline-block mr-1">
              <svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 7.91677H12.4167L10 0.416763L7.58333 7.91677H0L6.18335 12.3168L3.81668 19.5834L10 15.0834L16.1834 19.5834L13.8167 12.3168L20 7.91677Z" fill="#FFCB00"></path>
              </svg>
              </a>
              @endfor
          </div>
        </div>
        <h3 class="w-full md:w-auto text-l font-heading font-medium"><a class="nostyle" href="{{url('review', ['id' => $review['id']] )}}">{{$review['title']}} </a></h3>
        <p class="mb-8 max-w-2xl text-darkBlueGray-400 leading-loose">{{ $review['review_content'] }}</p>
      </div>
      <br>
      @endforeach

<!-- Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog relative w-auto pointer-events-none">
    <div
      class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
      <div
        class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">{{$movie['title']}}</h5>
        <button type="button"
          class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
          data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body relative p-4">
      <form action="{{url('store-review')}}" method="post">
                @csrf
      <div class="shadow sm:rounded-md sm:overflow-hidden">
                  <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                      <div class="col-span-3 sm:col-span-2">
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
                            <input class="appearance-none block w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="title" name="title">
                          </div>
                        </div>
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" >Content</label>
                        <div class="mt-1">
                          <input type="text" id="content" name="content" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                          <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                          <input type="hidden" id="movie_id" name="movie_id" value="{{$review['movie_id']}}">
                          </div>
              </form>     
      <div
        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
        <button type="button" class="px-6
          py-2.5
          bg-purple-600
          text-white
          font-medium
          text-xs
          leading-tight
          uppercase
          rounded
          shadow-md
          hover:bg-purple-700 hover:shadow-lg
          focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-purple-800 active:shadow-lg
          transition
          duration-150
          ease-in-out" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out
      ml-1">Submit</button>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>
      </div>
  </section>
</x-layout>