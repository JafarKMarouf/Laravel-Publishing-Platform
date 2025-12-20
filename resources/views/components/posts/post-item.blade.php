<div class="flex flex-col sm:flex-row bg-white border border-gray-200
rounded-lg shadow-sm mb-6">
    <div class="py-8 flex flex-col px-4 flex-1">
        <a href="{{
            route('post.show', [
                "username" => $post->user->username,
                "post"=>$post->slug
            ])
        }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                {{$post->title}}
            </h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 ">
            {{ Str::words($post->content, 20) }}
        </p>
        <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    {{$post->created_at->format('M j, Y')}}
                </span>
            <x-posts.clap-button :post="$post"/>
            <button
                class="flex items-center gap-2 text-gray-600
                    hover:text-gray-800
                    transition">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-5">
                    <path stroke-linecap="round"
                          d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"/>
                </svg>
                50
            </button>
        </div>
    </div>
    <a href="{{route('post.show', ["username" => $post->user->username, "post" =>$post->slug])}}"
       rel="noopener noreferrer">
        <img class="rounded-r-lg w-48 h-full max-h-80 object-cover"
             src="{{$post->imageUrl()}}"
             alt="{{$post->title}}"/>
    </a>
</div>
