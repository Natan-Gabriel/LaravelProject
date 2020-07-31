<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Tests\WithoutMiddleware;

class AircraftTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testStore()
	{
		$this->withoutMiddleware();
	    //WE WILL USE THIS HUB FOR OUR AIRCRAFTS
		$response = $this->call('POST', '/hubs/store', array(
        'name' => 'Hub','code' => 'HUB',
            'reputation' =>10,'price' =>10,
        ));
        $hub = \App\Hub::where('name' , '=', 'Hub')->first();



	    $this->assertDatabaseMissing('aircrafts', [
	        'name' => 'Sally','hub_id' => $hub->id,
	    ]);
	    

	    $response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Sally','hub_id' => $hub->id,
	    ));

	    $this->assertDatabaseHas('aircrafts', [
	        'name' => 'Sally',
	    ]);



	     
	     
	}


	public function testUpdate()
	{
		$this->withoutMiddleware();

		$hub = \App\Hub::where('name' , '=', 'Hub')->first();

	    $this->assertDatabaseHas('aircrafts', [
	         'name' => 'Sally','hub_id' =>  $hub->id,
	    ]);

	    $aircraft = \App\Aircraft::where('name' , '=', 'Sally')->first();

	    $response = $this->call('PATCH', '/aircrafts/'.$aircraft->id, array(
       'id' => $aircraft->id, 'name' => 'Sally2.0','hub_id' =>  $hub->id,
    	));


	     
	}


	public function testDestroy()
	{
		$this->withoutMiddleware();
	    

	    $this->assertDatabaseHas('aircrafts', [
	        'name' => 'Sally2.0',
	    ]);
	    

		// $response = $this->withHeaders([
  //           accept =>'application/json'
  //       ])->json('POST', '/aircrafts/store', ['name' => 'Sally','hub_id' => 1]);
	    // $response = $this->postJson('/aircrafts/store', ['name' => 'Sally','hub_id' => 1]);
	    
	    $aircraft = \App\Aircraft::where('name' , '=', 'Sally2.0')->first();

	    $response = $this->call('delete', '/aircrafts/delete/'.$aircraft->id, array(
        'id' => $aircraft->id,
   		 ));
	    // $response
     //        ->assertStatus(200)
     //        ->assertJson([
     //            'created' => true,
     //        ]);

	    $this->assertDatabaseMissing('aircrafts', [
	        'name' => 'Sally',
	    ]);
	    
	    $this->assertDatabaseMissing('aircrafts', [
	        'name' => 'Sally2.0',
	    ]);

	    
	}



	public function testValidationsAdd()
	{
		$this->withoutMiddleware();
		$hub = \App\Hub::where('name' , '=', 'Hub')->first();

		/*
		TEST UNIQUENESS OF NAMES
		*/

		$aircrafts_size = sizeof(\App\Aircraft::all());

	    $this->assertDatabaseMissing('aircrafts', [
	        'name' => 'Sally','hub_id' => $hub->id,
	    ]);

	    $this->assertDatabaseCount('aircrafts', $aircrafts_size);

	    $response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Sally','hub_id' =>$hub->id,
	    ));
	    $this->assertDatabaseCount('aircrafts', $aircrafts_size+1);

	    $response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Sally','hub_id' => $hub->id,
	    ));
	    $this->assertDatabaseCount('aircrafts', $aircrafts_size+1);

	    $aircraft = \App\Aircraft::where('name' , '=', 'Sally')->first();

	    $response = $this->call('delete', '/aircrafts/delete/'.$aircraft->id, array(
        'id' => $aircraft->id,
   		 ));

	    $this->assertDatabaseCount('aircrafts', $aircrafts_size);


	    /*
		TEST THE FACT THAT WE CANNOT ADD AIRCRAFTS WITH HUB_ID INEXISTENT IN HUB TABLE,i.e. OBEY PK CONSTRAINT FROM DB
		*/

		$response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Sally','hub_id' => -1,
	    ));
	    $this->assertDatabaseCount('aircrafts', $aircrafts_size);

	}



	public function testValidationsUpdate()
	{
		$this->withoutMiddleware();
		$hub = \App\Hub::where('name' , '=', 'Hub')->first();

		/*
		TEST UNIQUENESS OF NAMES
		*/

		$aircrafts_size = sizeof(\App\Aircraft::all());

	    $this->assertDatabaseMissing('aircrafts', [
	        'name' => 'Sally','hub_id' => $hub->id,
	    ]);

	    $response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Sally','hub_id' => $hub->id,
	    ));

	    $response = $this->call('POST', '/aircrafts/store', array(
        'name' => 'Sally2.0','hub_id' => $hub->id,
	    ));


	    $this->assertDatabaseCount('aircrafts', $aircrafts_size+2);

	    $aircraft = \App\Aircraft::where('name' , '=', 'Sally2.0')->first();

	    $response = $this->call('PATCH', '/aircrafts/'.$aircraft->id, array(
       'id' => $aircraft->id, 'name' => 'Sally','hub_id' => $hub->id,
    	));


    	$this->assertDatabaseHas('aircrafts', [
	        'name' => 'Sally2.0',
	    ]);


	    /*
		TEST THE FACT THAT WE CANNOT UPDATE AIRCRAFTS WITH HUB_ID INEXISTENT IN HUB TABLE,i.e. OBEY PK CONSTRAINT FROM DB
		*/

		$response = $this->call('PATCH', '/aircrafts/'.$aircraft->id, array(
       'id' => $aircraft->id, 'name' => 'IMPOSSIBLE','hub_id' => -1,
    	));

    	$this->assertDatabaseMissing('aircrafts', [
	        'name' => 'IMPOSSIBLE',
	    ]);


	    /*
	    DELETE INSERTED RECORDS
	    */
	    $aircraft = \App\Aircraft::where('name' , '=', 'Sally')->first();

	    $response = $this->call('delete', '/aircrafts/delete/'.$aircraft->id, array(
        'id' => $aircraft->id,
   		 ));

	    $aircraft = \App\Aircraft::where('name' , '=', 'Sally2.0')->first();

	    $response = $this->call('delete', '/aircrafts/delete/'.$aircraft->id, array(
        'id' => $aircraft->id,
   		 ));

	    $this->assertDatabaseCount('aircrafts', $aircrafts_size);


	    //DELETE THE USED HUB
        $response = $this->call('delete', '/hubs/delete/'.$hub->id, array('id' => $hub->id,
         ));

	}




}
