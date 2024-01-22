<?php

namespace Tests\Feature\Repositories;

use App\DTO\PostDto;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use WithFaker;

    public function testRepositoryCreatePost()
    {
         $data = [
            'title' => $this->faker->title,
            'description' => $this->faker->text(300)
         ];

        $postModel = Post::factory()->make($data);

        $mockPostRepository = $this->createMock(PostRepositoryInterface::class);

        $postDto = new PostDto($data);

        $mockPostRepository
            ->method('create')
            ->willReturn($postModel);

        $post = $mockPostRepository->create($postDto);

        $this->assertEquals($postDto->getTitle(), $post->title);
    }
}
