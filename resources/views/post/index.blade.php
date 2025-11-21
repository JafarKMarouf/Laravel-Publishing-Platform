<x-app-layout>
    <div class="py-4">
        <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <x-posts.category-tabs>
                No Category
            </x-posts.category-tabs>
            <div class="p-4 ">
                @if (session('success'))
                    <div
                        class="mb-3 bg-green-100 border border-green-400
                        text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span
                            class="block sm:inline">{{ session('success') }}</span>
                        <span
                            class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500"
                             role="button"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20"><title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.854l-2.651 2.995a1.2 1.2 0 1 1-1.697-1.697l2.995-2.651-2.995-2.651a1.2 1.2 0 1 1 1.697-1.697l2.651 2.995 2.651-2.995a1.2 1.2 0 0 1 1.697 1.697l-2.995 2.651 2.995 2.651a1.2 1.2 0 0 1 0 1.697z"/></svg>
                 </span>
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="mb-3 bg-red-100 border border-red-400
                        text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span
                            class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                @forelse($posts as $post)
                    <x-posts.post-item :post="$post"/>
                @empty
                    <div class="text-center text-gray-600 py-6">
                        No posts Found
                    </div>
                @endforelse
                <div class="mt-8">
                    {{ $posts->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
