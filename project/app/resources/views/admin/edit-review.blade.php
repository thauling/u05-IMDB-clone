<x-admin>
    <section class="flex flex-col items-center">
        <div class="flex flex-col">
            <h1 class="block text-gray-500 font-bold py-5">Find review by title or content</h1>
            <form class="w-full max-w-sm" method="get" action="{{url('/admin-search-review')}}">
                @csrf
                <div class="mb-6 flex">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="query">
                            Query
                        </label>
                    </div>
                    <div class="w-full">
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
                        <input class="mr-2 leading-tight" type="checkbox" name="is_approved" id="is_approved" value="yes" <?php echo $review->is_approved ? "checked" : ""; ?>>
                        Is approved.
                    </label>
                </div>

                <button type="submit" class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Update</button>
            </form>
        </div>

        @endif

        <div class="shadow bg-yellow-400 text-gray-500 font-bold md:text-left mb-1 md:mb-0 py-2 px-4 rounded"><a href="{{url('admin-main')}}">Back</a></div>
    </section>
</x-admin>