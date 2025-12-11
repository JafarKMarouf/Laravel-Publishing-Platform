<div class="mt-8">
    @forelse($posts as $post)
        <div class="flex flex-col sm:flex-row mb-12">
            <div class="flex-1 flex flex-col pr-8">
                <a href="{{route('post.show', ["username" => $post->user->username, "post" =>$post->slug])}}">
                    <h2 class="mb-2 text-3xl font-extrabold tracking-tight text-gray-900">
                        {{$post->title}}
                    </h2>
                </a>

                <p class="mb-3 font-normal text-gray-700 italic">
                    ({{\Illuminate\Support\Str::words($post->content, 12) }}
                    )
                </p>

                <div
                    class="flex items-center text-sm text-gray-500 mt-4">
                    <span
                        class="mr-4 mt-1/2">{{$post->created_at->format('M
                        j')}}
                    </span>

                    {{--       Clap             --}}
                    <span class="mr-3">
                        <x-posts.clap-button :post="$post"/>
                    </span>

                    {{--       Respond             --}}
                    <button
                        class="flex items-center gap-2 mr-4
                        hover:text-gray-900 transition">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"/>
                        </svg>
                        <span>50</span>
                    </button>

                </div>
            </div>
            <a href="{{route('post.show', ["username" => $post->user->username, "post" =>$post->slug])}}"
               rel="noopener noreferrer"
               class="mt-4 sm:mt-0 flex-shrink-0 w-full sm:w-48 h-32 sm:h-auto">
                <img
                    class="w-full h-full object-cover"
                    src="{{$post->imageUrl()}}"
                    alt="{{$post->title}}"/>
            </a>
        </div>

    @empty
        <div class="text-gray-500">
            No Post Found
        </div>
    @endforelse
</div>
