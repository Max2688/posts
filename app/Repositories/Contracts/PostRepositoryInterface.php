<?php

namespace App\Repositories\Contracts;

use App\DTO\PostDto;
use App\Models\Post;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param  PostDto $postData
     * @return Post
     */
    public function create(PostDto $postData): Post;

    /**
     * @param  int $id
     * @return Post
     */
    public function findById(int $id): Post;

    /**
     * @param  string $title
     * @return Post
     */
    public function findPostByTitle(string $title): Post;

    /**
     * @param  string $date
     * @return Collection
     */
    public function getPostsByCreatedAt(string $date): Collection;

    /**
     * @param  int $id
     */
    public function delete(int $id): void;

}
