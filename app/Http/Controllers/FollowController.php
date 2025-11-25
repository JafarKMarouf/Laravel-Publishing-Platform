<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class FollowController extends Controller
{
    public function followUnFollow(User $user): JsonResponse
    {
        $user->followers()->toggle(auth()->id());
        return response()->json([
            'followersCount' => $user->followers()->count()
        ]);
    }
}
