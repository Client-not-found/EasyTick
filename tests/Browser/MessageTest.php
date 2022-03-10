<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MessageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login');
        });
    }

    public function testHead()
    {
        $browser->visit('/newarticle')->assertTitleContains('Ticketsystem');
        $browser->visit('/newarticle')->assertUrlIs('http://localhost:8000/newarticle');
    }
}
