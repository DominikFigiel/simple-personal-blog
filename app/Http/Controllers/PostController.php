<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\DestroyPostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Repository\Post\PostRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(): View
    {
        $posts = $this->postRepository->getPostsPaginated(5);

        return view('post.list', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('post.add', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postRepository->createPost($request);

        if (!empty($post)){
            return redirect()
            ->route('posts.index')
            ->with('success', 'Post został dodany.');
        }

        return redirect()
            ->route('posts.index')
            ->with('error', 'Post nie został dodany.');
    }

    public function edit(int $postId)
    {
        $categories = Category::all();
        $post = $this->postRepository->getPostById($postId);


        if($post)
        {
            return view('post.edit', compact('post', 'categories'));
        }

        return redirect()
            ->route('posts.index');
    }

    public function update(UpdatePostRequest $request)
    {
        $post = $this->postRepository->updatePost($request, $request['id']);

        if (!empty($post)){
            return redirect()
            ->route('posts.index')
            ->with('success', 'Post został zaktualizowany.');
        }

        return redirect()
            ->route('posts.index')
            ->with('error', 'Post nie został zaktualizowany.');
    }

    public function destroy(int $postId)
    {
        $post = $this->postRepository->deletePost($postId);

        if (!empty($post)){
            return redirect()
            ->route('posts.index')
            ->with('success', 'Post został usunięty.');
        }

        return redirect()
            ->route('posts.index')
            ->with('error', 'Usuwanie posta nie powiodło się.');
    }

    public function show(string $slug)
    {
        $post = $this->postRepository->getPostBySlug($slug);

        if (!empty($post))
        {
            return view('blog.show', compact('post'));
        }

        return redirect()
            ->route('posts.index');
    }

    public function postIndex()
    {
        $posts = $this->postRepository->getPostsPaginated(5);

        return view('blog.index', compact('posts'));
    }

    public function welcomePage()
    {
        $posts = $this->postRepository->getPostsPaginated(5);

        return view('blog.welcome', compact('posts'));
    }

    public function convertTextToSlug(string $text): string
    {
        return Str::slug($text, '-');
    }
}
