<x-admin>
    <section class="flex flex-col items-center">
        <div>
            @if (session()->has('success'))
            <div class="bg-red-500" x-data="{ show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show">
                <p>{{ session()->get('success') }}</p>
            </div>
            @endif
            <div class="py-5">
                <h2 class="block text-gray-500 font-bold">Find User by name or email</h2>
                <form class="w-full max-w-sm" method="get" action="{{url('search-user')}}">
                    @csrf
                    <div class="mb-6 flex">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="query">
                                Query
                            </label>
                        </div>
                        <div class="w-full">
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="query" value="" placeholder="Enter name or email">
                        </div>

                        <div class="md:w-2/3">
                            <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                Find
                            </button>
                        </div>
                    </div>
                </form>

                @if (isset($user))
                <h2 class="block text-gray-500 font-bold">Edit User</h2>

                <form class="w-full max-w-sm" action="{{ url('update-user', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">Name</label>
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="name" name="name" id="name" value="{{ $user->name }}" class="" placeholder="name">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">Email</label>
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="email" name="email" id="email" value="{{ $user->email }}" class="" placeholder="email">

                    <!-- 
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="password">Password</label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="password" name="password" id="password" value="{{ $user->password }}" class="" placeholder="Password"> -->
                    <div class="md:flex md:items-center mb-6">
                        <label class="md:w-2/3 block text-gray-500 font-bold" for="is_admin">
                            <input class="mr-2 leading-tight" type="checkbox" name="is_admin" id="is_admin" value="yes" <?php echo $user->is_admin ? "checked" : ""; ?>>
                            Is admin?
                        </label>
                    </div>

                    <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" class="">Update</button>


                </form>
                @endif
            </div>
            @if(isset($user))
            @if (!empty(json_decode($user->watchlist)))
            <div class="py-5">
                <h2 class="block text-gray-500 font-bold">Movie Watchlist of {{$user->name}}</h2>
                <table class="w-full max-w-sm">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Movie Title
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($user->watchlist) as $movie_id)
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">

                            <td class="text-sm text-gray-900 font-light lg:px-6 py-4 max-w-xs">
                                {{array_search($movie_id, $allMovies) ? array_search($movie_id, $allMovies) : 'not available';}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            @endif
        </div>
        <div class="shadow bg-yellow-400 text-gray-500 font-bold md:text-left mb-1 md:mb-0 py-2 px-4 rounded"><a href="{{url('admin-main')}}">Back</a></div>
    </section>

</x-admin>