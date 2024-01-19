<?php
namespace App\Repositories;

use App\DTO\PostDto;
use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Collection;

final class PostRepository implements PostRepositoryInterface
{
    /**
     *
     * @inheritDoc
     */
    public function all(): Collection
    {
        return Post::with('comments')
            ->get();
    }

    /**
     *
     * @inheritDoc
     */
    public function create(PostDto $postData): Post
    {
        $data = [
            'title' => $postData->getTitle(),
            'description' => $postData->getDescription()
        ];

        return Post::create($data);
    }

    /**
     *
     * @inheritDoc
     */
    public function findById(int $id): Post
    {
        $post = Post::with('comments')->find($id);

        if(!$post) {
            throw new PostNotFoundException('Post not found by id ' . $id);
        }

        return $post;
    }

    /**
     *
     * @inheritDoc
     */
    public function findPostByTitle(string $title): Post
    {
        $post = Post::with(['comments' => function($query){
            $query->orderBy('id', 'desc');
        }])
            ->where('title', $title)
            ->first();
        if(!$post) {
            throw new PostNotFoundException('Post not found by title ' . $title);
        }

        return $post;
    }

    /**
     *
     * @inheritDoc
     */
    public function getPostsByCreatedAt(string $date): Collection
    {
        $posts = Post::whereDate('created_at','=',$date)->get();
        return $posts;
    }

    /**
     *
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        Post::destroy($id);
    }
}
