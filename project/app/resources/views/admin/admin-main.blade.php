<?php
// use App\Models\Movie;
// $myId = 11;
//echo Movie::where('id', $myId)->get()->first()->title;
// print_r(array_values($allMovies)); //keys()->all());
// print_r(array_keys($allMovies)); 
// print_r(array_search($myId, $allMovies)); 
//print_r(gettype($allMovies)); 
//dd(($allMovies->keys()))
?>
<x-admin>
    <!-- logic for handling site visibility, permission dependent -->
    @unless (Auth::check())
    <h1>You are not signed in.</h1>
    @endunless
    @if (Auth::check() && Auth::user()->is_admin)

    <div class="block text-gray-500 font-bold">
        <h1 class="">Dashboard</h1>
        <span class=""> Hi admin {{Auth::user()->name}} ! </span>

    </div>
    <!-- dashboard 
- able to add new movies and information about movies in an ordered way.
- ability to separate movies into different categories and provide additional metadata about each movie, 
    as well as linking them to actors, directors and so on.
- able to track what users of the website are doing in terms of reviewing movies and putting in their watchlists
- able to grant and remove roles to different users, granting them access to specific functionality as either 
    an admin or restricting them to a regular user.
-->
    <section class="flex">
        <div class="flex-col p-20">
            <h2>Add a Movie</h2>

            <form class="w-full max-w-sm" method="post" action="{{url('store-movie')}}">
                @csrf
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="title">
                            Title
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="title" type="text" value="" required>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="abstract">
                            Abstract
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <textarea rows="5" cols="50" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="abstract" required>
                    </textarea>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="released">
                            Released
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="released" type="number" value="" required>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="genre">
                            Genre
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="genre" type="text" value="" required>
                    </div>
                </div>
                <!-- <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="urls_images">
                        Image URLs
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="urls_trailer" type="text" value="">
                </div>
            </div> -->
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
                    <div class="md:w-2/3">
                        <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Save
                        </button>
                    </div>
                </div>
            </form>
            <div class="mt-10">
                <a href="{{url('movie-cast')}}" class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold mr-2 py-2 px-4 rounded">Add cast</a>
                <!-- <a href="{{url('movie-images')}}" class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Add images</a> -->
            </div>
        </div>

        <div class="flex-col p-20">
            <h2>Add a User</h2>
            <!-- Search for user and update details -->
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
                    <!-- <div class="md:w-1/3"></div> -->
                    <label class="md:w-2/3 block text-gray-500 font-bold" for="is_admin">
                        <input class="mr-2 leading-tight" type="checkbox" name="is_admin" value="yes">
                        Is admin?
                    </label>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-2/3">
                        <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" name="register" type="submit">
                            Register
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </section>

    <section>
    <div class="flex-col px-20 py-10">
    @if ($users->count() || $movies->count() || $reviews->count())
    <h2>Total number of Movies, Users, Reviews</h2>
    <div class="container">
        <div id="columnGraph"> </div> <!--  style="height: 600px; width: 100%"> replace this with tailwind-->
    </div>
    </div>



    @endif
    </section>
    <!-- Display a CRUD action message -->
    <section class="bg-red-500">
        <!-- class ="message"-->
        @if (session()->has('success'))
        <section x-data="{ show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show">
            <!-- need to import alpine for this to work -->
            <p>{{ session()->get('success') }}</p>
        </section>
        @endif
    </section>

    <section>
        <h2>CRUD User Tracking</h2>
        <!-- table and/ or chart on user stats -->
        @if ($users->count())
        <!-- "$users->links" to be used with paginate-->
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-100 border-b">
                                <tr>

                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Name
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Email
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Created
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- fix pagination -->
                                @foreach ($users as $user)
                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$user->name}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$user->email}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$user->created_at}}
                                    </td>

                                    <td class="flex flex-col">
                                        <form method="post" action="{{url('edit-user',$user->id)}}">
                                            <!-- "flex justify-start content-start" -->
                                            @csrf

                                            <div class="md:w-1/6">
                                                <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-1 rounded" type="submit">Edit</button>
                                            </div>
                                        </form>
                                        <form method="post" action="{{url('destroy-user',$user->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="md:w-1/6">
                                                <button class="shadow bg-red-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-1 rounded" type="submit">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- show pagination -->
                        {{ $users->links() }}

                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <p>
        No movies found.
    </p>
    @endif

    <section>
        <h2>CRUD Movie Tracking</h2>
        <!-- table and/ or chart on user stats -->
        @if ($movies->count())
        <!-- "$movies->links" to be used with paginate-->
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Title
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left max-w-sm">
                                        Abstract
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Genre
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Average Rating
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- fix pagination -->
                                @foreach ($movies as $movie)
                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$movie->title}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-normal max-w-sm">
                                        {{$movie->abstract}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-normal max-w-xs">
                                        {{$movie->genre}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 max-w-xs">
                                        {{$movie->avg_rating}}
                                    </td>
                                    @auth
                                    <td class="flex flex-col">

                                        <a class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-1 rounded" href="/movies/{{$movie['id']}}/edit">Edit</a>
                                        <!-- "flex justify-start content-start" -->

                                        <form method="post" action="{{url('destroy-movie',$movie->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="md:w-1/6">
                                                <button class="shadow bg-red-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-1 rounded" type="submit">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                    @endauth
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- show pagination -->
                        {{ $movies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @else
    <p>
        No movies found.
    </p>
    @endif

    <section>
        <h2>CRUD Review Tracking</h2>
        <!-- table and/ or chart on user stats -->
        @if ($reviews->count())
        <!-- "$movies->links" to be used with paginate-->
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Title
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left max-w-sm">
                                        Content
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left max-w-sm">
                                        Rating
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        User
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Movie
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Created
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- fix pagination -->
                                @foreach ($reviews as $review)
                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{$review->title}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-normal max-w-sm">
                                        {{$review->review_content}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-normal max-w-xs">
                                        {{$review->review_rating}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 max-w-xs">
                                        {{array_search($review->user_id, $allUsers) ? array_search($review->user_id, $allUsers) : 'anonymous';}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 max-w-xs">
                                        {{array_search($review->movie_id, $allMovies) ? array_search($review->movie_id, $allMovies) : 'not available';}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 max-w-xs">
                                        {{$review->created_at}}
                                    </td>
                                    @auth
                                    <td class="flex flex-col">

                                        <a class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-1 rounded" href="/review/{{$review['id']}}/edit">Edit</a>
                                        <!-- "flex justify-start content-start" -->

                                        <form method="post" action="{{url('destroy-review',$review->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="md:w-1/6">
                                                <button class="shadow bg-red-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-1 rounded" type="submit">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                    @endauth
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- show pagination -->
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @else
    <p>
        No movies found.
    </p>
    @endif

    @else
    <h1>Sorry mate, you must me an ADMIN to view this.</h1>
    @endif

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Draw the bar chart that displays total numbers of users, movies, reviews.
        google.charts.setOnLoadCallback(drawBarChart);

        function drawBarChart() {

            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Table');
            data.addColumn('number', 'total');
            data.addRows([
                ['Users', <?php echo $usercount ?>],
                ['Movies', <?php echo $moviecount ?>],
                ['Reviews', <?php echo $reviewcount ?>]
            ]);

            const options = {
                width: 400,
                height: 240,
                is3D: true,
                title: 'Total number of users, movies, reviews',
                isStacked: true
            };

            // instantiate and draw the chart
            const chart = new google.visualization.ColumnChart(document.querySelector('#columnGraph'));
            chart.draw(data, options);
        }
    </script>
</x-admin>