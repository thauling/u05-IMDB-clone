<?php
$logo = asset('assets/images/imdb_logo.png');
?>




<nav class="flex justify-between  md:flex-row flex-col items-center">

    <a href="/">
        <img src="{{ $logo }}" alt="IMDb" width="80px">
    </a>

    <div class="my-2">
        <form class="flex gap-x-1" action="{{ url('/search-movie') }}" method="get">
            @csrf
            <input class="rounded border border-solid border-gray-400 py-2 px-2" type="text" placeholder="search"
                name="s">

            <button type="submit"
                class="bg-gray-500 text-white border border-gray-600 hover:bg-blue-300 font-bold py-2 px-4 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5 m-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </form>
    </div>

    @if (Route::has('login'))
        <div class="flex gap-x-2">
            @auth
                <div>
                    <a href="{{ url('/userpage') }}"
                        class="text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline">{{ Auth::user()->name }}</a>
                </div>

                <form action="/logout" method="POST">
                    @csrf
                    <a href="/logout" class="text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline"
                        onclick="this.closest('form').submit(); event.preventDefault();">Logout</a>
                </form>
                @if (Auth::user()->is_admin)
                    <div>
                        <a href="{{ url('/admin-main') }}"
                            class="text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline">Dashboard</a>
                    </div>
                @endif
            @else
                <a href="/login" class="text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm text-gray-700 hover:text-gray-500 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
</nav>
