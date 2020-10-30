<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetRoutesTest extends TestCase
{
    use RefreshDatabase;

    
    public function testGetImages()
    {
        $response = $this->getJson(route('images.index'));

        $response->assertStatus(200);
    }


    public function testGetAlbums()
    {
        $response = $this->getJson(route('albums.index'));

        $response->assertStatus(200);
    }
}
