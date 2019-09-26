<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagewidgetsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagewidgets', function(Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('widget_id');
			$table->integer('page_id');
			$table->string('zone');
			$table->integer('row');
			$table->integer('col');
			$table->integer('width');
			$table->text('data');
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
		Schema::drop('pagewidgets');
	}
}
