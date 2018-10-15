<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LSimpleTest extends DuskTestCase
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
            ->click('.mynewrecord')
            ->type('uuid', 'testing type2')
            ->select('status')
            ->click('.mysave');
        });
    }
}
