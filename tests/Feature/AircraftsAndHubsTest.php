<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AircraftsAndHubsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testStore()
    {
     $this->withoutMiddleware();
        // Make call to application...

        /*
        ADD ENTITES TO DB
        */
        

        $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Hub','code' => 'HUB',
            'reputation' =>10,'price' =>10,
        ));

        $this->assertDatabaseHas('hubs', [
            'name' => 'Hub','code' => 'HUB',
            'reputation' =>10,'price' =>10,
        ]);


        $hub = \App\Hub::where('name' , '=', 'Hub')->first();


        $response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Aircraft1','hub_id' => $hub->id,
        ));

        $this->assertDatabaseHas('aircrafts', [
            'name' => 'Aircraft1',
        ]);

        /*
        IF WE DELETE THE AIRCRAFT,THE HUB WON'T BE DELETED
        */

        $aircraft = \App\Aircraft::where('name' , '=', 'Sally2.0')->first();

        $this->assertDatabaseHas('hubs', [
            'name' => 'Hub','code' => 'HUB',
            'reputation' =>10,'price' =>10,
        ]);

        /*
        IF WE DELETE THE HUB,ALL ASSOCIATED AIRCRAFTS WILL BE DELETED
        */

        $response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Aircraft1','hub_id' => $hub->id,
        ));

        $response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Aircraft2','hub_id' => $hub->id,
        ));


        $response = $this->call('delete', '/hubs/delete/'.$hub->id, array('id' => $hub->id,
         ));

        $this->assertDatabaseMissing('hubs', [
            'name' => 'Hub','code' => 'HUB',
            'reputation' =>10,'price' =>10,
        ]);

        $this->assertDatabaseMissing('aircrafts', [
            'name' => 'Aircraft1',
        ]);

        $this->assertDatabaseMissing('aircrafts', [
            'name' => 'Aircraft2',
        ]);





         
         
    }
}
