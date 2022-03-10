<?php

namespace Tests\Browser;

use App\Models\Ticket;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TicketTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tickets')
                    ->assertSee('Ticket list');
        });
    }

    public function testList(Browser $browser)
    {
        $browser->visit('/tickets')->assertTitleContains('Dashboard')
        ->assertUrlIs('http://localhost:8000/tickets');
    }

    public function testCreate(Browser $browser)
    {
        $browser->visit('/newticket')->assertTitleContains('Create Ticket');
        $browser->visit('/newticket')->assertUrlIs('http://localhost:8000/newticket');
    }

    public function testDashboard(Browser $browser)
    {
        $browser->visit('/home')->assertTitleContains('Dashboard');
        $browser->visit('/home')->assertUrlIs('http://localhost:8000/home');
    }
}
