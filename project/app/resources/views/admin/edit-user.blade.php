<!-- <?php
        $searchemail = "ralph";
        ?> -->
<!-- need to redirect from controller->find() that sends $user -->
<x-admin>
    <div class="flex justify-center items-center flex-col">
        <h2 class="block text-gray-500 font-bold">Find User by name or email</h2>
        <form class="w-full max-w-sm" method="get" action="{{url('search-user')}}">
            <!-- need to fix this -->
            @csrf
            <!-- <div class="md:flex md:items-center mb-6"> -->
            <div class="mb-6 flex">
                <div class="md:w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="query">
                        Query
                    </label>
                </div>
                <div class="w-full">
                    <!-- md:w-2/3 -->
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
        <!-- this shoudl suffice since search returns Null if query is not found -->
        <h2 class="block text-gray-500 font-bold">Edit User</h2>

        <form class="w-full max-w-sm" action="{{ url('update-user', $user->id) }}" method="POST">
            @csrf
            @method('PUT')


            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">Name</label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="name" name="name" id="name" value="{{ $user->name }}" class="" placeholder="name">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">Email</label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="email" name="email" id="email" value="{{ $user->email }}" class="" placeholder="email">


            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="password">Password</label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="password" name="password" id="password" value="{{ $user->password }}" class="" placeholder="Password">

            <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" class="">Update</button>


        </form>
        @endif
    </div>

</x-admin>