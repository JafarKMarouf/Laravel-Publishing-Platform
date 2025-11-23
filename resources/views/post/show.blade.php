<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{-- Main Section Post--}}
        <div class="w-full bg-white border border-gray-200 rounded-lg
                shadow-sm mb-6 px-8 py-6">
            <h1 class="text-3xl sm:text-[40px] font-extrabold leading-tight tracking-tight text-gray-900 mb-6">
                {{$post->title}}
            </h1>
            {{--         User Avatar               --}}
            <div class="flex items-center gap-4">
                <x-user-avatar :user="$post->user"/>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <a href="{{route('profile.show', $post->user)}}"
                           class="hover:underline text-lg text-gray-700">
                            <h3> {{$post->user->username}}</h3>
                        </a>
                        <span class="text-gray-400 ">&middot;</span>
                        <a href="#"
                           class="text-green-600 text-lg hover:text-green-700
                           font-medium">
                            Follow
                        </a>
                    </div>
                    <div
                        class="flex items-center gap-2 text-sm text-gray-500">
                        <span>{{$post->readTime()}} min read</span>
                        <span>&middot;</span>
                        <span>{{$post->created_at->format('M j, Y')
                            }}</span>
                    </div>
                </div>
            </div>
            {{--         Clap Section            --}}
            <x-clap-section/>
            {{--         Clap Section            --}}

            {{--         Content Section            --}}
            <div class="mt-8 w-full mx-auto">
                <div class="w-full flex justify-center my-8">
                    <img src="{{ $post->imageUrl() }}"
                         alt="{{ $post->title }}"
                         class="w-3/4 h-auto object-cover rounded shadow-md"/>
                </div>
                <div
                    class="mb-10 text-lg leading-relaxed text-gray-800 font-serif">
                    {!! $post->content !!}
                </div>
            </div>
            {{--         Content Section            --}}

            {{--         Category Section            --}}
            <div class="mt-4">
                <button class="rounded-2xl px-4 py-2 bg-gray-300
                text-gray-800">
                    {{$post->category->name}}
                </button>
            </div>
            {{--         Category Section            --}}

            {{--         Clap Section            --}}
            <x-clap-section/>
            {{--         Clap Section            --}}
        </div>
    </div>
</x-app-layout>
