@props(['user', 'size' => 'w-16 h-16'])

<div class="flex-shrink-0">
    @if($user->image)
        <img
            src="{{ $user->imageUrl() }}"
            alt="{{ $user->username }}'s profile
                              picture"
            class="{{$size}} rounded-full object-cover
                            shadow-xl transition duration-300">
    @else
        <x-letter-avatar
            :name="$user->username"
            size="70px"
            class="shadow-xl transition duration-300"
        />
    @endif
</div>
