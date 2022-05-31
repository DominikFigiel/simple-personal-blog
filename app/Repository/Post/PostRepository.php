<?php

declare(strict_types=1);

namespace App\Repository\Post;

use Illuminate\Http\Request;

interface PostRepository
{
    public function getPosts();
    public function getPostsPaginated(int $limit);
    public function getPostById(int $id);
    public function getPostBySlug(string $slug);
    public function createPost(Request $request);
    public function updatePost(Request $request, $id);
    public function deletePost(int $id);
    public function convertTextToSlug(string $text);
}


