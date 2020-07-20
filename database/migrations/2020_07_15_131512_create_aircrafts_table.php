<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAircraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('aircrafts');

        Schema::create('aircrafts', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->unique();
      
      // $table->foreignId('hub_id')->constrained('hubs')->onDelete('cascade');
      $table->integer('hub_id')->unsigned()->index();
      $table->foreign('hub_id')->references('id')->on('hubs')->onDelete('cascade');
      $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aircrafts');
    }
}
