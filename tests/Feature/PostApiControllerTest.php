<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStorePostApi()
    {
        $response = $this->post('api/posts',
            [
                'title' => 'Post test',
                'description' => 'desc test'
            ]
        );

        $response->assertStatus(201);
    }
}
