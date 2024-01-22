<?php

namespace Tests\Feature\Repositories;

use App\DTO\PostDto;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use WithFaker;

    public function testCreatePostRepository()
    {
        $data = [
            'title' => $this->faker->title,
            'description' => $this->faker->text(300)
        ];

        $postRepository = new PostRepository();

        $postDto = new PostDto($data);

        $post = $postRepository->create($postDto);

        $this->assertEquals($postDto->getTitle(), $post->title);
    }
}
