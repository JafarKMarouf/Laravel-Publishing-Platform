<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PublicProfileController extends Controller
{
    public function show(User $user): Factory|View
    {
        $posts = $user->posts()->latest()->paginate(5);
        return view('profile.show', [
            'user' => $user, 'posts' => $posts
        ]);
    }
}
