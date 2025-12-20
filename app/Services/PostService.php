<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    public function createPost($request): void
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
        $query = Post::select(['id', 'title', 'slug', 'content', 'user_id', 'created_at'])
            ->with(['user', 'media'])
            ->withCount('claps')
            ->latest();

        if ($user) {
            $ids = $user->following()->pluck('users.id');
            $query->whereIn('user_id', $ids);
        }
        return $query;
    }

    /**
     * @param int $postId
     * @return Post|Collection|Model|null
     */
    public function getPostDetail(int $postId): Post|Collection|Model|null
    {
        return Post::select(['id', 'title', 'slug', 'content', 'user_id', 'category_id', 'created_at'])
            ->with([
                'media',
                'category:id,name,slug',
            ])
            ->withCount('claps')
            ->findOrFail($postId);
    }


    /**
     * @return User|Builder|HasMany
     */
    public function myPosts(): User|Builder|HasMany
    {
        $user = auth()->user();
        return $user->posts()
            ->with([
                'user',
                'media',
            ])
            ->withCount('claps')
            ->latest();
    }
}
