<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    { }

        public function test_an_action_that_requires_authentication()
        {
            $user = User::factory()->create();
    
            $response = $this->actingAs($user)
                             ->withSession(['banned' => false])
                             ->get('/');
        }

    public function testManagement(Browser $browser)
    {
        $browser->visit('/usermanagement')->assertTitleContains('User management');
        $browser->visit('/usermanagement')->assertUrlIs('http://localhost:8000/usermanagement');
    }

    public function testNewuser(Browser $browser)
    {
        $browser->visit('/newuser')->assertTitleContains('New User');
        $browser->visit('/newuser')->assertUrlIs('http://localhost:8000/newuser');
    }
}