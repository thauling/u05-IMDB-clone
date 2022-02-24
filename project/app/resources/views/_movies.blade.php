<article class="max-w-fw mx-auto flex border max-h-64 my-5 bg-white rounded ">
                        
                        <div class="w-1/4 border mr-10">
                            <a href="/movies/{{ $movie->id }}">
                        @if ($movie->urls_images)
                            <img src=" {{ $imgPath }}" alt="movie comver image" width="100%" height= "auto" class="opacity-30 hover:opacity-100">
                        @else
                            NO IMG
                        @endif
                            </a>
                        </div>

                        <div class="py-10">
                            <a href="/movies/{{ $movie->id }}" class="hover:text-red-700">
                                <h2 class="text-lg font-bold block">
                                    {{ $movie->title }}
                                </h2>
                            </a>

                            <p class="block">
                            {{ $movie->genre }}
                            </p>
                        </div>

                        <div class="ml-10 pt-10">
                            <h3 class="font-bold">Cast</h3>
                            <ul class="text-sm sm:text-base">
                            @foreach(json_decode($movie->cast) as $actor)
                                <li>{{ $actor }}</li>
                            @endforeach
                            </ul>
                        </div>
                    </article>