<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('hubs');
        Schema::disableForeignKeyConstraints();

        Schema::create('hubs', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->unique();
      $table->string('code')->unique();
      $table->integer('price');
      $table->integer('reputation');
      $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hubs');
    }
}
