<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Browser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/')
            ->assertStatus(200)
            ->assertSee('UUID');


        $response = $this->get('records')
            ->assertStatus(200);

               
        $response = $this->call('POST', '/records', [
            'uuid'=> 'testing23',
            'status'=> 'active'
        ]);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->call('PUT', 'records/4', [
            'uuid'=> 'testingPUT',
            'status'=> 'active'
        ]);  
        //$this->assertEquals(200, $response->getStatusCode());   

        $response = $this->call('DELLETE', 'records/3');
    }
}
