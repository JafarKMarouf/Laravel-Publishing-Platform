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
                        class="mr-4">{{$post->created_at->format('M j')}}
                    </span>

                    {{--       Clap             --}}
                    <button
                        class="flex items-center
                        gap-2 mr-4 hover:text-gray-900
                        transition">
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
                                d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"/>
                        </svg>
                        <span>310</span>
                    </button>

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
