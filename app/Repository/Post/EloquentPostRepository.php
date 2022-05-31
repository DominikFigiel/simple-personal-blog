<?php

namespace App\Repository\Post;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EloquentPostRepository implements PostRepository
{
    private Post $postModel;

    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    public function getPosts()
    {
        return $this->postModel::with('tags')->get();
    }

    public function getPostsPaginated(int $limit)
    {
        return $this->postModel::with('tags')->paginate($limit);
    }

    public function getPostById(int $id)
    {
        return $this->postModel->whereId($id)->first();
    }

    public function getPostBySlug(string $slug)
    {
        return $this->postModel->where('slug', $slug)->first();
    }

    public function createPost(Request $request)
    {
        $post = new $this->postModel;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->attach($request->tags);

        return $post;
    }

    public function updatePost(Request $request, $id)
    {
        $post = $this->postModel->whereId($id)->first();
        if ($post != null) {
            $post->update([
                'title' => $request->title,
                'slug' => $request->description,
                'description' => $request->description,
                'body' => $request->description,
                'category_id' => $request->description
            ]);
            return $post;
        }
        return null;
    }

    public function convertTextToSlug(string $text)
    {
        return Str::slug($text, '-');
    }
}
