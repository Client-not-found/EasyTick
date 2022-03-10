<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testKnowledgebase()
    {
        $response = $this->get('/knowledgebase');

        $response->assertStatus(302);

    }

    public function testArticle()
    {
        $response = $this->get('/newarticle');

        $response->assertStatus(302);

    }
}
