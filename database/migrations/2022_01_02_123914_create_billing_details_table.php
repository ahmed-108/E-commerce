<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('billing_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('userID_ibfk_6');
			$table->string('full_name');
			$table->integer('phone1');
			$table->integer('phone2')->nullable();
			$table->string('country', 10000);
			$table->string('city', 1000);
			$table->integer('zip_code');
			$table->string('full_address', 1000);
			$table->text('notes');
			$table->string('payment_method');
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
		Schema::drop('billing_details');
	}

}
