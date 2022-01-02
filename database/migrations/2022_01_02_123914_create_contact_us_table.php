<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_us', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('first_name', 1000);
			$table->string('email', 1000);
			$table->integer('phone');
			$table->string('subject', 10000);
			$table->string('message', 1000);
			$table->timestamps(10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contact_us');
	}

}
