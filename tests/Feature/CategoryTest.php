<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testManagement()
    {
        $response = $this->get('/knowledgemanagement');

        $response->assertStatus(302);
    }

    public function testCreate()
    {
        $response = $this->get('/newcategory');

        $response->assertStatus(302);
    }
}
