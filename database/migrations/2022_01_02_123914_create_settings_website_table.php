<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsWebsiteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings_website', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('phone');
			$table->integer('hotline');
			$table->string('address', 10000);
			$table->string('hours', 1000);
			$table->string('facebook', 1000);
			$table->string('insta', 1000);
			$table->string('pinterest', 1000);
			$table->string('twitter', 1000);
			$table->string('youtube', 1000);
			$table->dateTime('created_at')->nullable();
			$table->dateTime('updated_at')->nullable();				
	
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings_website');
	}

}
