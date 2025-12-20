<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
        $categories = Category::all();
        return view('post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->postService->updatePost($request, $post->id);
        return redirect()
            ->route('post.me')
            ->with('update', 'Post updated successfully!');
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->deletePost($post->id);
        return redirect()
            ->route('post.me')
            ->with('delete', 'Post Delete successfully!');
    }
}
