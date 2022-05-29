<?php

namespace App\Repositories\Contracts;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    /**
     * @param  array<int, string>  $postData
     * @return Comment
     */
    public function create(array $postData): Comment;

    /**
     * @param  int $id
     */
    public function delete(int $id): void;
}
