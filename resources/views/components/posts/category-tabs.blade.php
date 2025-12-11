<div class="bg-white shadow m-4 rounded-lg">
    <ul class="py-4 flex flex-wrap justify-center text-sm font-medium text-center text-gray-500 dark:text-gray-400">
        @php
            $activeClass = 'text-white bg-blue-600';
            $inactiveClass = 'text-gray-900 hover:text-white hover:bg-blue-600';
        @endphp
        @if($categories->count()>0)
            <li class="me-2">
                <a href="{{ route('dashboard') }}"
                   class="inline-block px-4 py-3 rounded-lg {{ !request()->routeIs('post.category') ? $activeClass : $inactiveClass }}"
                   aria-current="page">
                    All
                </a>
            </li>
            @foreach ($categories as $category)
                <li class="me-2">
                    <a href="{{route('post.category',$category->slug)}}"
                       class="inline-block px-4 py-3 rounded-lg
                       {{ request()->url() === route('post.category', $category->slug) ? $activeClass : $inactiveClass }}">
                        {{$category->name}}
                    </a>
                </li>
            @endforeach
        @else
            <li class="me-2 inline-block px-4 py-3 rounded-lg ">
                {{$slot}}
            </li>
        @endif
    </ul>

</div>
