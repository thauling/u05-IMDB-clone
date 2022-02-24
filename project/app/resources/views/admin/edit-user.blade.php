<!-- <?php
$searchemail = "ralph";
?> -->
<!-- need to redirect from controller->find() that sends $user -->
<x-admin>
<h2>Find User by name or email</h2>
    <form class="w-full max-w-sm" method="get" action="{{url('search-user')}}"> <!-- need to fix this -->
        @csrf
        <!-- <div class="md:flex md:items-center mb-6"> -->
        <div class="mb-6 flex">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="query">
                   Query
                </label>
            </div>
            <div class="w-full"> <!-- md:w-2/3 -->
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" 
                type="text" name="query" value="" placeholder="Enter name or email">
            </div>
        
        <div class="md:w-2/3">
            <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Find
            </button>
        </div>
        </div>
    </form>

    @if (isset($user)) <!-- this shoudl suffice since search returns Null if query is not found -->
    <h2>Edit User</h2>
 
    <form action="{{ url('update-user', $user->id) }}" method="POST">
        @csrf
        @method('PUT')


        <label for="name">Name</label>
        <input type="name" name="name" value="{{ $user->name }}" class="" placeholder="name">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="" placeholder="email">


        <label for="password">Password</label>
        <input type="password" name="password" value="{{ $user->password }}" class="" placeholder="Password">

        <button type="submit" class="">Update</button>


    </form>
@endif

</x-admin>