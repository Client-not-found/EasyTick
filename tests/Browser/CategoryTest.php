<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/newcategory')
                    ->assertSee('Laravel');
        });
    }

    public function testManagement(Browser $browser)
    {
        $browser->visit('/knowledgemanagement')->assertTitleContains('knowledgebase management');
        $browser->visit('/home')->assertUrlIs('http://localhost:8000/knowledgemanagement');
    }

    public function testCreate(Browser $browser)
    {
        $browser->visit('/newcategory')->assertTitleContains('New Category');
        $browser->visit('/newcategory')->assertUrlIs('http://localhost:8000/newcategory');
    }
}