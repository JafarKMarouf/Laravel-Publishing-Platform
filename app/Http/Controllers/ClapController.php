<?php

namespace App\Http\Controllers;

use App\Models\Clap;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class ClapController extends Controller
{
    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function clap(Post $post): JsonResponse
    {
        $hasClap = auth()->user()->hasClap($post);

        if ($hasClap) {
            $post->claps()->where('user_id',auth()->user()->id)->delete();
        } else {
            Clap::query()->create([
                'post_id' => $post->id,
                'user_id' => auth()->user()->id
            ]);
        }
        return response()->json([
            'clapsCount' => $post->claps()->count(),
        ]);
    }
}
