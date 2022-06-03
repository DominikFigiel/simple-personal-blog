<?php

namespace App\Repository\Post;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $newImage = $request->image;

        $path = null;

        if (!empty($newImage)) {
            $path = $newImage->store('post-thumbnails', 'public');


            if ($path) {
                $newImage = $path;
            }
        }

        $post->image = $newImage;

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
                'slug' => $request->slug,
                'description' => $request->description,
                'body' => $request->body,
                'category_id' => $request->category_id
            ]);

            $newImage = $request->image;

            $path = null;
            if (!empty($newImage)) {
                $path = $newImage->store('post-thumbnails', 'public');
                // $path = $newImage->storeAs('post-thumbnails', $post->id() . '.png', 'public');

                if ($path) {
                    if(!empty($post->image))
                    {
                        Storage::disk('public')->delete($post->image);
                    }
                    $newImage = $path;
                }

                $post->update([
                    'image' => $newImage
                ]);
            }



            return $post;
        }
        return null;
    }

    public function deletePost(int $id)
    {
        $post = $this->getPostById($id);

        if (!empty($post)){

            $path = null;
            if (!empty($post->image)) {
                Storage::disk('public')->delete($post->image);
                $post->image = $path;
            }

            // $post->tags()->detach();

            $post->delete();

            return $post;
        }
        return null;
    }

    public function convertTextToSlug(string $text)
    {
        return Str::slug($text, '-');
    }
}
