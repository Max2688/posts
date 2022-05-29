<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param  array<int, string>  $postData
     * @return Post
     */
    public function create(array $postData): Post;

    /**
     * @param  int $id
     * @return Model
     */
    public function findById(int $id): Model;

    /**
     * @param  string $title
     * @return Model
     */
    public function findPostByTitle(string $title): Model;

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
