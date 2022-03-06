<!DOCTYPE html>
<html lang="en">

<body>


    @include('_head')

    @include('_nav')
    <div class="container">
        <div class="py-8">
            @if (isset($image))
                <?php
                $path = substr($image->path, 6, strpos($image->path, '.jpg'));
                ?>
                <img src="{{ asset('storage' . $path) }}" alt="profile image"
                    class="shadow object-cover w-36 h-36 align-middle border-none rounded-full">
            @else
                <img src="https://vectorified.com/images/generic-avatar-icon-12.jpg" alt="profile image"
                    class="shadow object-cover w-36 h-36 align-middle border-none rounded-full" />
            @endif
        </div>
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">{{ Auth::user()->name }}</h1>
    </div>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto flex flex-wrap">
            <div class="flex flex-wrap -m-4">
                <div class="p-4 lg:w-1/2 md:w-full">
                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                        <div
                            class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium "><a
                                    href="userratings/{{ Auth::id() }}">Your Reviews/Ratings</a></h2>
                            <p class="leading-relaxed text-base">See and edit all of your ratings and reviews.</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 lg:w-1/2 md:w-full">
                    <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                        <div
                            class="w-16 h-16 sm:mr-8 sm:mb-0 mb-4 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="flex-grow mb-6">
                            <h2 class="text-gray-900 text-lg title-font font-medium"><a
                                    href="user/user-settings">Settings</a></h2>
                            <p class="leading-relaxed text-base">Change the settings of your profile.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (!empty($watchlist))
        <section class="text-gray-600 body-font">
            <h2 class="text-center sm:text-3xl text-2xl font-medium title-font  text-gray-900">Your watchlist!</h2>
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">
                    @foreach ($watchlist as $movie)
                        <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <a href="{{ url('movies', $movie['id']) }}"><img
                                        class="lg:h-48 md:h-36 w-full object-cover object-center"
                                        src="{{ $movie['urls_images'] }}" alt="movie-poster"> </a>
                                <div class="p-6">
                                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                        {{ $movie['genre'] }}</h2>
                                    <h2 class="title-font text-lg font-medium text-gray-900 mb-3"><a
                                            href="{{ url('movies', $movie['id']) }}">{{ $movie['title'] }}</a></h2>
                                    <p class="leading-relaxed mb-3">{{ $movie['abstract'] }}</p>
                                    <div class="flex items-center flex-wrap ">
                                        <a href="{{ url('/user/watchlist/remove', $movie['id']) }}"
                                            class="text-red-500 inline-flex items-center md:mb-2 lg:mb-0">Remove from
                                            watchlist
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <h2 class="text-center sm:text-3xl text-2xl font-medium title-font  text-gray-900">Your watchlist!</h2>

        <h2
            class="text-center ml-4 mr-4 md:ml-28 md:mr-28 bg-white pt-2 pb-2 text-black border-4 border-b-8 border-indigo-500">
            Your
            watchlist is empty, try adding a movie to it!</h2>
    @endif
</body>

</html>
