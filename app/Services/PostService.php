<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PostService
{

    /**
     * @param $request
     * @return void
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function create($request): void
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $randomSuffix = Str::random(6);
        $data['slug'] = Str::slug($data['title']) . '-' . $randomSuffix;

        $imageFile = $data['image'] ?? null;
        unset($data['image']);

        $post = Post::query()->create($data);
        $post->addMedia($imageFile)
            ->preservingOriginal()
            ->toMediaCollection('posts');
    }

    /**
     * @return Post|Builder
     */
    public function getLatest(): Post|Builder
    {
        $user = auth()->user();
        $query = Post::select(['id','title', 'slug', 'content', 'user_id', 'created_at'])
            ->with('user')
            ->latest();

        if ($user) {
            $ids = $user->following()->pluck('users.id');
            $idsToShow = $ids->prepend($user->id)->unique();
            $query->whereIn('user_id', $idsToShow);
        }
        return $query;
    }
}
