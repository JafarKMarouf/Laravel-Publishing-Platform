<x-app-layout>
    <div class="py-4">
        <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <x-posts.category-tabs>
                No Category
            </x-posts.category-tabs>
            <div class="p-4 ">
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
