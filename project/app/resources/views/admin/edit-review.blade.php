<?php

// use App\Models\Movie;

// if (isset($_GET['dynaInput'])) {
//     //print_r($_GET['dynaInput']);
//     $id = $_GET['movie_id'];
//     $cast = [];
//     //DB::table('movies')->where('id', $id)->update(['cast' => json_encode(array('Mr T', 'Jack', 'Gina'))]);
//     //DB::table('movies')->where('id', $id)->update(['cast' => json_encode(array(array_values($_GET)))]); //this works
//     for ($i = 0; $i < count($_GET['dynaInput']); $i++) {
//         $cast[] = array_values($_GET['dynaInput'][$i]);
//     };
//     $flattened_cast = array_reduce($cast, 'array_merge', []);
//     Movie::where('id', $id)->update(['cast' => json_encode(array_values($flattened_cast))]);
// };
?>

<x-admin>
    <div class="flex flex-col p-10">
        <h1 class="block text-gray-500 font-bold">Find review by title or content</h1>
        <form class="w-full max-w-sm" method="get" action="{{url('/admin-search-review')}}">
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
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" name="query" value="" placeholder="Type something">
                </div>

                <div class="md:w-2/3">
                    <button class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        Find
                    </button>
                </div>
            </div>
        </form>
    </div>
    @if (isset($review))
    <div class="flex flex-col p-10">
    <h2 class="block text-gray-500 font-bold">Edit Review</h2>

        <form class="w-full max-w-sm" action="{{ url('update-approve-review', $review->id) }}" method="POST">
            @csrf
            @method('PUT')


            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="title">Title</label>
            <input type="title" name="title" value="{{ $review->title }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="review_content">Content</label>
            <input type="text" name="review_content" value="{{ $review->review_content }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="review_rating">Rating</label>
            <input type="text" name="review_rating" value="{{ $review->review_rating }}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="">

            <div class="md:flex md:items-center mb-6">
            <label class="md:w-2/3 block text-gray-500 font-bold" for="is_approved">
                <input class="mr-2 leading-tight" type="checkbox" name="is_approved" id="is_approved" value="yes" <?php echo $review->is_approved ? "checked":""; ?>>
                Is approved.
            </label>
            </div>

            <button type="submit" class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>
  
    @endif

    <div class="black text-gray-500 font-bold md:text-left mb-1 md:mb-0 p-10"><a href="{{url('admin-main')}}">Back</a></div>

</x-admin>