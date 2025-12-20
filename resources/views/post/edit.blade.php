<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="mb-4 items-center text-2xl">Edit post</h1>
            <div class="bg-white shadow-md overflow-hidden sm:rounded-lg p-4">
                <form method="POST" action="{{ route('post.update', $post)
                 }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <!-- Upload Image -->
                    <div class="mt-4">
                        <div class="w-3/4 mx-auto my-8 justify-center">
                            <a href="{{$post->imageUrl(true)}}"
                               target="_blank">
                                <img src="{{ $post->imageUrl(true) }}"
                                     alt="{{ $post->title }}"
                                     class="w-3/4 h-auto object-cover rounded shadow-md"/>
                            </a>
                        </div>
                        <x-input-label for="image"
                                       :value="__('Upload Image')"/>
                        <x-text-input id="image"
                                      class="block mt-1 w-full "
                                      type="file" name="image"
                                      :value="old('image')"
                                      autofocus/>
                        <x-input-error :messages="$errors->get('image')"
                                       class="mt-2"/>
                    </div>
                    <!-- Title -->
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input id="title" class="block mt-1 w-full"
                                      type="text" name="title"
                                      :value="old('title', $post->title)"
                                      autofocus/>
                        <x-input-error :messages="$errors->get('title')"
                                       class="mt-2"/>
                    </div>

                    <!-- Select Category -->
                    <div class="mt-4">
                        <x-input-label for="category_id"
                                       :value="__('Category')"/>

                        <select id="category_id"
                                class="block mt-1 w-full border-gray-300
                                focus:border-indigo-500
                                focus:ring-indigo-500 rounded-md shadow-sm"
                                name="category_id">
                            <option selected>Choose a category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{$category->id}}" @selected(old
                                    ('category_id', $category->id) ==
                                    $category->id)
                                >{{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')"
                                       class="mt-2"/>
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')"/>
                        <x-input-textarea id="content"
                                          class="block mt-1 w-full"
                                          type="text" name="content"
                                          autofocus>{{old('content',
                                          $post->content)
                                          }}</x-input-textarea>
                        <x-input-error :messages="$errors->get('content')"
                                       class="mt-2"/>
                    </div>

                    <!-- Save Post -->
                    <x-primary-button class="mt-4">
                        {{ __('Save') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
