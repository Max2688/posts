<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiControllerTest extends TestCase
{
    use WithFaker;

    public function testStorePostApi()
    {
        $response = $this->post('api/posts',
            [
                'title' => $this->faker->title,
                'description' => $this->faker->text
            ]
        );

        $response->assertStatus(201);
    }
}
