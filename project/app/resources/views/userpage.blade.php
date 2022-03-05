
@include('_head')

@include('_nav')
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap w-full mb-20">
      <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">{{@Auth::user()->name}}</h1>
        <div class="h-1 w-20 bg-indigo-500 rounded"></div>
      </div>
      <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Here is all the movies you have put on your watchlist so far!</p>
    </div>
    @foreach($watchlist as $movie)
    <div class="flex flex-wrap -m-4">
      <div class="xl:w-1/4 md:w-1/2 p-4">
        <div class="bg-gray-100 p-6 rounded-lg">
          <img class="h-40 rounded w-full object-cover object-center mb-6" src="{{ $movie['urls_images'] }}" alt="content">
          <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">{{$movie['genre']}}</h3>
          <h2 class="text-lg text-gray-900 font-medium title-font mb-4">{{$movie['title']}}</h2>
          <p class="leading-relaxed text-base">{{$movie['abstract']}}</p>
        </div>
      </div>
    </div>
    @endforeach
</section>
    <div class="container">
        <input  type="file" name="userimage" placeholder="Choose profile picture" id="userimage">
    </div>
    <section class="text-gray-600 body-font">

      <div class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          <div class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
          </svg>
          </div>
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3"><a href="userratings/{{Auth::id()}}">Your Reviews/Ratings</a></h2>
            <p class="leading-relaxed text-base">Here you can see all the ratings and reviews you have left on movies.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
