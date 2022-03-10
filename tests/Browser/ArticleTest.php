<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ArticleTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('/newarticle')
                    ->assertSee('Laravel');
        });
    }

    public function testList(Browser $browser)
    {
        $browser->visit('/knowledgebase')->assertTitleContains('Knowledge Base');
        $browser->visit('/knowledgebase')->assertUrlIs('http://localhost:8000/knowledgebase');
    }

    public function testCreate(Browser $browser)
    {
        $browser->visit('/newarticle')->assertTitleContains('Ticketsystem');
        $browser->visit('/newarticle')->assertUrlIs('http://localhost:8000/newarticle');
    }
}
