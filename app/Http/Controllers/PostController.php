<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\DestroyPostRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function index(): View
    {
        $posts = Post::paginate(5);

        return view('post.list', compact('posts'));
    }

    public function create(): View
    {
        return view('post.add');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $postTitle = $data['title'];
        $postSlug = $this->convertTextToSlug($data['slug']);
        $postDescription = $data['description'];
        $postBody = $data['body'];

        $post = new Post;

        $post->title = $postTitle;
        $post->slug = $postSlug;
        $post->description = $postDescription;
        $post->body = $postBody;

        $post->save();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post został dodany.');
    }

    public function edit(int $postId)
    {
        $post = Post::find($postId);

        if($post)
        {
            return view('post.edit', compact('post'));
        }

        return redirect()
            ->route('posts.index');
    }

    public function update(UpdatePostRequest $request)
    {
        $post = Post::find($request['id']);

        if($post)
        {
            $post->title = $request['title'];
            $post->slug = $this->convertTextToSlug($request['slug']);
            $post->description = $request['description'];;
            $post->body = $request['body'];;

            $post->save();

            return redirect()
            ->route('posts.index')
            ->with('success', 'Post został zaktualizowany.');
        }
    }

    public function destroy(int $postId)
    {
        $post = Post::find($postId);

        if($post)
        {
            $post->delete();

            return redirect()
            ->route('posts.index')
            ->with('error', 'Post został usunięty.');
        }
        else
        {
            return redirect()
            ->route('posts.index')
            ->with('error', 'Wystąpił błąd. Post nie został usunięty.');
        }
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        if($post)
        {
            return view('blog.show', compact('post'));
        }

        return redirect()
            ->route('posts.index');
    }

    public function postIndex()
    {
        $posts = Post::paginate(5);

        return view('blog.index', compact('posts'));
    }

    public function convertTextToSlug(string $text): string
    {
        return Str::slug($text, '-');
    }
}