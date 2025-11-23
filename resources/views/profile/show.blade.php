<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    <div class="flex-1 px-8">
                        <div class="justify-between items-center">
                            <h1 class="text-4xl font-bold">{{$user->name}}</h1>
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

                    <div class="w-1/4 sticky top-20 border-l px-8">
                        <x-user-avatar :user="$user" size="w-24 h-24"/>
                        <h1 class="mt-2">{{$user->name}}</h1>
                        <p class="mt-2  text-gray-500">930 Followers</p>

                        <p class="mt-2 text-gray-500">{{$user->bio}}</p>

                        <div class="mt-4">
                            <x-primary-button
                                class="rounded-2xl">
                                Follow
                            </x-primary-button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
