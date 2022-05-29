<?php
namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;

final class CommentRepository implements CommentRepositoryInterface
{
    public function create(array $commentData): Comment
    {
        return Comment::create($commentData);
    }

    public function delete(int $id): void
    {
        Comment::destroy($id);
    }
}
