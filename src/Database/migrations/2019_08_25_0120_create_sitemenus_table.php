<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitemenusTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sitemenus', function(Blueprint $table) {
			$table->engine = 'InnoDB';
      		$table->increments('id');
			$table->string('menu');
			$table->string('description');
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
		Schema::drop('sitemenus');
	}
} 