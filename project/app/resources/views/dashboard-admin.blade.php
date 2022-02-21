<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- include tailwind via CDN for testing, change this to local installation later  -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!-- also include alpine and hard-code version later -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <!-- logic for handling site visibility, permission dependent -->
    @unless (Auth::check())
    <h1>You are not signed in.</h1>
    @endunless
    @if (Auth::check())
    <h1>Dashboard</h1>
    <!-- dashboard 
- able to add new movies and information about movies in an ordered way.
- ability to separate movies into different categories and provide additional metadata about each movie, 
    as well as linking them to actors, directors and so on.
- able to track what users of the website are doing in terms of reviewing movies and putting in their watchlists
- able to grant and remove roles to different users, granting them access to specific functionality as either 
    an admin or restricting them to a regular user.
-->
    <section class="message">
        @if (session()->has('success'))
        <section x-data="{ show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show">
            <!-- need to import alpine for this to work -->
            <p>{{ session()->get('success') }}</p>
        </section>
        @endif
    </section>
    <section class="flex">
        <h2>CRUD Movie Details</h2>
        <!-- 
    <form method="post" action="{{url('store-movie')}}">
        @csrf
        <label class="" for="title">Title</label>
        <input type="text" name="title" required>

        <label class="" for="abstract">Abstract</label>
        <input type="text" name="abstract" required>

        <label class="" for="cast">Cast</label>
        <input type="text" name="cast" required>

        <label class="" for="genre">Genre</label>
        <input type="text" name="genre" required>

        <label class="" for="urls_images">Image URLs</label>
        <input type="text" name="urls_images" required>

        <label class="" for="url_trailer">Trailer URL</label>
        <input type="text" name="url_trailer" required>
        <button type="submit" class="btn btn-primary">Save</button> 
    </form>
     -->

        <form class="w-full max-w-sm" method="post" action="{{url('store-movie')}}">
            @csrf
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="title">
                        Title
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="title" type="text" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="abstract">
                        Abstract
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="abstract" type="abstract" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="cast">
                        Cast
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="cast" type="text" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="genre">
                        Genre
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="genre" type="text" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="urls_images">
                        Image URLs
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="urls_trailer" type="text" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="url_trailer">
                        Trailer URL
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="url_trailer" type="text" value="">
                </div>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        Save
                    </button>
                </div>
            </div>
        </form>

        <h2>CRUD User Details and Permissions</h2>
        <!--
    <form method="post" action="{{url('store-user')}}">
       
        @csrf
        <label class="" for="name">Name</label>
        <input type="text" name="name" required>

        <label class="" for="email">Email</label>
        <input type="text" name="email" required>

        <label class="" for="password">Password</label>
        <input type="text" name="password" required>

        <label class="" for="is_admin">Is admin</label>
        <input type="checkbox" name="is_admin" value="yes">

        <button type="submit" class="btn btn-primary">Save</button> 
    </form>
-->

        <form class="w-full max-w-sm" method="post" action="{{url('store-user')}}">
            @csrf
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                        Name
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="name" type="text" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">
                        Email
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="email" type="email" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="password">
                        Password
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="password" type="password" value="">
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3"></div>
                <label class="md:w-2/3 block text-gray-500 font-bold" for="is_admin">
                    <input class="mr-2 leading-tight" type="checkbox" name="is_admin" value="yes">
                    Is admin?
                </label>
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </section>

    <h2>CRUD User Tracking</h2>
    <!-- table and/ or chart on user stats -->
    @if ($users->count())
    <p>
        <!-- "$users->links" to be used with paginate-->
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-100 border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Email
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Password
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- fix pagination -->
                            @foreach ($users as $user)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$user->name}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$user->email}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$user->password}}
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

    <h2>CRUD Single User Tracking (test)</h2>
    <p> {{ $user }}</p>

    @endif
</body>

</html>