<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $comments = $this->collection;
        $data = [];
        foreach ($comments as $comment){
            $data[] = [
                "id"    => $comment->id,
                "comment"  => $comment->comment,
            ];
        }
        return [
            "data" => $data
        ];
    }
}
