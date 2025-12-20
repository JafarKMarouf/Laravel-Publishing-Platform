<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PostController extends Controller
{
    public function __construct(private readonly PostService $postService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = $this->postService->getLatest();
        $posts = $query->paginate(5);
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * @param Category $category
     * @return View
     */
    public function filterByCategory(Category $category): View
    {
        $query = $this->postService->getLatest();
        $posts = $query->where('category_id', $category->id)
            ->paginate(5);
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create(): Factory|View
    {
        $categories = Category::all();
        return view('post.create', [
            'categories' => $categories
        ]);
    }

    /**
     * @param StorePostRequest $request
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $this->postService->createPost($request);
        return redirect()
            ->route('dashboard')
            ->with('status', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post): View
    {
        $data = $this->postService->getPostDetail($post->id);
        return view('post.show', ['post' => $data]);
    }

    public function myPosts(): View
    {
        $posts = $this->postService
            ->myPosts()
            ->paginate(5);

        return view('post.my_posts', [
            'posts' => $posts,
            'user' => $posts->first()->user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }


}
