<!DOCTYPE html>
<html lang="en">

<body>


    @include('_head')

    @include('_nav')
    <h1 class="text-center sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Your reviews!</h1>
    @if (session('status'))
        <div class="ml-4 mr-4 md:ml-28 md:mr-28 bg-white pt-2 pb-2 text-black border-4 border-b-8 border-green-500">
            <div class="ml-4 mr-4">
                {{ session('status') }}
            </div>
        </div>
    @endif
    @foreach ($reviews as $review)
        <?php $date = date_create($review['created_at']); ?>
        <div class="mb-2 shadow-lg rounded-t-8xl rounded-b-5xl overflow-hidden">
            <div class="pt-3 pb-3 md:pb-1 px-4 md:px-16 bg-white bg-opacity-40">
                <div class="flex flex-wrap items-center">
                    <h2 class="w-full md:w-auto text-xl font-heading font-medium">
                        {{ array_search($review->movie_id, $allMovies) }} </h2>
                    <div class="w-full md:w-px h-2 md:h-8 mx-8 bg-transparent md:bg-gray-200"></div>
                    <div class="inline-flex">
                        @for ($i = 0; $i < $review['review_rating']; $i++)
                            <a class="inline-block mr-1" href="#">
                                <svg width="20" height="20" viewbox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 7.91677H12.4167L10 0.416763L7.58333 7.91677H0L6.18335 12.3168L3.81668 19.5834L10 15.0834L16.1834 19.5834L13.8167 12.3168L20 7.91677Z"
                                        fill="#FFCB00"></path>
                                </svg>
                            </a>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="px-4 overflow-hidden md:px-16 pt-8 pb-12 bg-white">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-2/3 mb-6 md:mb-0">
                        <h3 class="w-full md:w-auto text-l font-heading font-medium">{{ $review['title'] }} </h3>
                        <p class="mb-8 max-w-2xl text-darkBlueGray-400 leading-loose">{{ $review['review_content'] }}
                        </p>
                        <div class="-mb-2">
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 text-right">
                        <p class="mb-8 text-sm text-gray-600">Created at {{ date_format($date, 'Y-m-d') }}</p>
                        <div class="-mb-2">
                            <div class="inline-flex w-full md:w-auto md:mr-2 mb-2">
                                <div
                                    class="flex items-center h-12 pl-2 pr-6 bg-green-100 border-2 border-green-500 rounded-full">
                                    <a href="/edit-review/{{ $review['id'] }}"
                                        class="text-green-500 font-heading font-medium">Edit</a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="-mb-2">
                            <div class="inline-flex w-full md:w-auto md:mr-2 mb-2">
                                <div
                                    class="flex items-center h-12 pl-2 pr-6 bg-red-100 border-2 border-red-500 rounded-full">
                                    <a href="/delete-review/{{ $review['id'] }}"
                                        class="text-red-500 font-heading font-medium">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    @endforeach
    <a class=" mx-auto mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
        href="{{ url()->previous() }}"> Go back</a>

</body>

</html>
