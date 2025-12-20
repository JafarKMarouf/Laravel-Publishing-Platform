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
        </div>
    </div>
    <a href="{{route('post.show', ["username" => $post->user->username, "post" =>$post->slug])}}"
       rel="noopener noreferrer">
        <img class="rounded-r-lg w-48 h-full max-h-80 object-cover"
             src="{{$post->imageUrl()}}"
             alt="{{$post->title}}"/>
    </a>
</div>
