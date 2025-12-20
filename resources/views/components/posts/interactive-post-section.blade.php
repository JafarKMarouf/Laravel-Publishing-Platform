@auth
    @props(['post'])
    <div
        class="flex items-center justify-between mt-8 py-3
                    border-y border-gray-300 text-gray-500">
        <div class="flex items-center gap-6">
            {{--       Clap             --}}
            <x-posts.clap-button :post="$post"/>
        </div>

        @if($post->user_id == Auth::user()->id)
            <div class="flex items-center gap-4">
                <a href="{{route('post.edit', $post->slug)}}">
                    <x-secondary-button>
                        Edit Post
                    </x-secondary-button>
                </a>
                <form method="POST" action="{{ route('post.delete', $post)
                 }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>
                        Delete Post
                    </x-danger-button>
                </form>

            </div>
        @endif

    </div>
@endauth
