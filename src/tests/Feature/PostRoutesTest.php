<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreImage()
    {
        $response = $this->postJson(route('images.store'), ['name'=>'plane.jpg', 'path'=>'/images/planes/']);

        $response->assertStatus(201);
    }
}
