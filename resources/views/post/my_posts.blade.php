<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('update'))
                <div class="mb-3 bg-green-100 border border-green-400
                        text-green-700 px-4 py-3 rounded relative"
                     x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     x-init="setTimeout(() => show = false, 2000)">
                    <strong class="block sm:inline">
                        {{ session('update') }}
                    </strong>
                </div>
            @endif

            @if (session('delete'))
                <div class="mb-3 bg-red-100 border border-red-400
                        text-red-700 px-4 py-3 rounded relative"
                     x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     x-init="setTimeout(() => show = false, 2000)">
                    <strong class="block sm:inline">
                        {{ session('delete') }}
                    </strong>
                </div>
            @endif
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    {{--        User Posts            --}}
                    <div class="flex-1 px-8">
                        <div class="justify-between items-center">
                            <h1 class="text-4xl
                            font-bold">{{$user->name}}</h1>
                        </div>

                        <div class="mt-8 border-b border-gray-300">
                            <ul class="flex space-x-6 text-lg text-gray-500">
                                <li class="border-b-2 border-black pb-2 text-black font-medium">
                                    Home
                                </li>
                                <li class="pb-2">Lists</li>
                                <li class="pb-2">About</li>
                            </ul>
                        </div>

                        @include('profile.partials.show-user-posts-list')
                        <div class="mt-8">
                            {{ $posts->onEachSide(1)->links() }}
                        </div>
                    </div>

                    {{--          User Infos           --}}
                    <x-posts.follow-button :user="$user"
                                           class="w-1/4 top-20 border-l px-10">
                        <x-user-avatar :user="$user" size="w-24 h-24"/>
                        <h1 class="mt-2">{{$user->name}}</h1>

                        <p class="mt-2  text-gray-500">
                            <span x-text="followersCount"></span> Followers
                        </p>

                        <p class="mt-2 text-gray-500">{{$user->bio}}</p>
                    </x-posts.follow-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
