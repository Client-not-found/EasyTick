<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class TicketTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testList()
    {
        $response = $this->get('/tickets');


        $response->assertStatus(302);
        
    }

    public function testDashboard()
    {
        $response = $this->get('/home');


        $response->assertStatus(302);
        
    }

    public function testCreate()
    {
        $response = $this->get('/newTicket');


        $response->assertStatus(302);
        
    }
}
