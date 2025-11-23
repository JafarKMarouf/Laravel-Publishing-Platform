<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Str;

class PostService
{
    public function create($request): void
    {
        $data = $request->validated();
        $image = $data['image'];
        unset($data['image']);

        $data['user_id'] = auth()->user()->id;
        $randomSuffix = Str::random(6);
        $data['slug'] = Str::slug($data['title']) . '-' . $randomSuffix;

        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;

        Post::query()->create($data);
    }
}
