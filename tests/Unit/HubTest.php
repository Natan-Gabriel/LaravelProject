<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Tests\WithoutMiddleware;

class HubTest extends TestCase
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
	    // Make call to application...

	    $this->assertDatabaseMissing('hubs', [
	        'name' => 'Sally','code' => 'SLL',
	        'reputation' =>10,'price' =>10,
	    ]);
	    

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally','code' => 'SLL',
	        'reputation' =>10,'price' =>10,
	    ));

	    $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally','code' => 'SLL',
	        'reputation' =>10,'price' =>10,
	    ]);

	     
	     
	}


	public function testUpdate()
	{
		$this->withoutMiddleware();
	    // Make call to application...

	    $this->assertDatabaseHas('hubs', [
	         'name' => 'Sally','code' => 'SLL',
	        'reputation' =>10,'price' =>10,
	    ]);

	    $hub = \App\Hub::where('name' , '=', 'Sally')->first();

	    $response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'id' => $hub->id, 'name' => 'Sally2.0','code' => 'SLE',
	        'reputation' =>9,'price' =>9,
    	));
	     
	}


	public function testDestroy()
	{
		$this->withoutMiddleware();
	    // Make call to application...

	    $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0',
	        'code' => 'SLE',
	        'reputation' =>9,'price' =>9,
	    ]);
	    

		// $response = $this->withHeaders([
  //           accept =>'application/json'
  //       ])->json('POST', '/aircrafts/store', ['name' => 'Sally','hub_id' => 1]);
	    // $response = $this->postJson('/aircrafts/store', ['name' => 'Sally','hub_id' => 1]);
	    
	    $hub = \App\Hub::where('name' , '=', 'Sally2.0')->first();

	    $response = $this->call('delete', '/hubs/delete/'.$hub->id, array(
        'id' => $hub->id,
   		 ));
	    // $response
     //        ->assertStatus(200)
     //        ->assertJson([
     //            'created' => true,
     //        ]);

	    $this->assertDatabaseMissing('hubs', [
	        'name' => 'Sally',
	    ]);
	    
	    $this->assertDatabaseMissing('hubs', [
	        'name' => 'Sally2.0',
	    ]);
	    
	}



	public function testValidationsAdd()
	{
		$this->withoutMiddleware();

		/*
		TEST UNIQUENESS OF NAMES
		*/

		$hubs_size = sizeof(\App\Hub::all());
	    

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally','code' => 'SLL',
	        'reputation' =>10,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size+1);

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally','code' => 'SLP',
	        'reputation' =>10,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size+1);

	    $hub = \App\Hub::where('name' , '=', 'Sally')->first();

	    $response = $this->call('delete', '/hubs/delete/'.$hub->id, array(
        'id' => $hub->id,
   		 ));


	    /*
		TEST UNIQUENESS OF CODE
		*/
	    

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally','code' => 'SLL',
	        'reputation' =>10,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size+1);

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally2.0','code' => 'SLL',
	        'reputation' =>10,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size+1);

	    $hub = \App\Hub::where('name' , '=', 'Sally')->first();

	    $response = $this->call('delete', '/hubs/delete/'.$hub->id, array(
        'id' => $hub->id,
   		 ));


	    /*
		TEST THE FACT THAT THE CODE MUST HAVE EXACTLY 3 LETTERS
		*/


		$response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally','code' => 'SLLP',
	        'reputation' =>10,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size);

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally2.0','code' => 'SL',
	        'reputation' =>10,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size);

	    /*
		TEST THE FACT THAT THE REPUTATION MUST BE IN THE INTERVAL [0,100]
		*/

		$response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally','code' => 'SLL',
	        'reputation' =>-1,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size);

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally2.0','code' => 'SLP',
	        'reputation' =>101,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size);


	    /*
		TEST THE FACT THAT THE COST MUST BE IN THE INTERVAL [0,100000]
		*/

		$response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally','code' => 'SLL',
	        'reputation' =>1,'price' =>-1,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size);

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally2.0','code' => 'SLP',
	        'reputation' =>1,'price' =>100001,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size);

	}



	public function testValidationsUpdate()
	{
		$this->withoutMiddleware();

		/*
		TEST UNIQUENESS OF NAMES
		*/

		$hubs_size = sizeof(\App\Hub::all());
	    

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally','code' => 'SLL',
	        'reputation' =>10,'price' =>10,
	    ));

	    $response = $this->call('POST', '/hubs/store', array(
        'name' => 'Sally2.0','code' => 'SLP',
	        'reputation' =>10,'price' =>10,
	    ));

	    $this->assertDatabaseCount('hubs', $hubs_size+2);

	    $hub = \App\Hub::where('name' , '=', 'Sally2.0')->first();


	    $response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'name' => 'Sally','code' => 'SLP',
	    'reputation' =>10,'price' =>10,
    	));

    	 $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0',
	    ]);


	    /*
		TEST UNIQUENESS OF CODE
		*/
	    

	    $response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'name' => 'Sally2.0','code' => 'SLL',
	    'reputation' =>10,'price' =>10,
    	));

    	 $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0','code' => 'SLP',
	    ]);



	    /*
		TEST THE FACT THAT THE CODE MUST HAVE EXACTLY 3 LETTERS
		*/


		$response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'name' => 'Sally2.0','code' => 'SLL',
	    'reputation' =>10,'price' =>10,
    	));

    	 $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0','code' => 'SLP',
	    ]);

    	 $response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'name' => 'Sally2.0','code' => 'SL',
	    'reputation' =>10,'price' =>10,
    	));

    	 $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0','code' => 'SLP',
	    ]);

	    /*
		TEST THE FACT THAT THE REPUTATION MUST BE IN THE INTERVAL [0,100]
		*/

		$response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'name' => 'Sally2.0','code' => 'SLP',
	    'reputation' =>-1,'price' =>10,
    	));

    	 $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0', 'reputation' =>10,
	    ]);

    	 $response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'name' => 'Sally2.0','code' => 'SLP',
	    'reputation' =>101,'price' =>10,
    	));

    	 $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0', 'reputation' =>10,
	    ]);


	    /*
		TEST THE FACT THAT THE COST MUST BE IN THE INTERVAL [0,100000]
		*/

		$response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'name' => 'Sally2.0','code' => 'SLP',
	    'reputation' =>10,'price' =>-1,
    	));

    	 $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0', 'price' =>10,
	    ]);

    	 $response = $this->call('PATCH', '/hubs/'.$hub->id, array(
       'name' => 'Sally2.0','code' => 'SLP',
	    'reputation' =>10,'price' =>100001,
    	));

    	 $this->assertDatabaseHas('hubs', [
	        'name' => 'Sally2.0', 'price' =>10,
	    ]);

    	 /*
		DEELTE THE USED HUBS
		*/


    	 $hub = \App\Hub::where('name' , '=', 'Sally')->first();

	    $response = $this->call('delete', '/hubs/delete/'.$hub->id, array(
        'id' => $hub->id,
   		 ));

	    $hub = \App\Hub::where('name' , '=', 'Sally2.0')->first();

	    $response = $this->call('delete', '/hubs/delete/'.$hub->id, array(
        'id' => $hub->id,
   		 ));

	}


}
