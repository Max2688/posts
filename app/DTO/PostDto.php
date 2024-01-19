<?php

namespace App\DTO;

use Illuminate\Support\Arr;

class PostDto
{
    private string $title;

    private string $description;

    public function __construct(array $postData)
    {
        $this->title = Arr::get($postData, 'title');
        $this->description = Arr::get($postData, 'description');
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
