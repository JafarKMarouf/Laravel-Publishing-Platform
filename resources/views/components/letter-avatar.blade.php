@props(['name', 'size' => '40px'])

@php
    $initials = strtoupper(Str::of($name ?? 'U')->substr(0, 1));
    $colors = ['#673AB7', '#2196F3', '#00BCD4', '#4CAF50', '#FF9800', '#F44336'];
    $key = crc32($name ?? 'Unknown') % count($colors);
    $bgColor = $colors[$key];
@endphp

<div
    {{ $attributes->merge(['class' => 'avatar-placeholder']) }}
    style="
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: {{ $size }};
        height: {{ $size }};
        border-radius: 50%;
        background-color: {{ $bgColor }};
        color: #ffffff;
        font-size: calc({{ $size }} / 2.5);
        font-weight: bold;
        text-transform: uppercase;
        flex-shrink: 0;
    "
>
    {{ $initials }}
</div>
