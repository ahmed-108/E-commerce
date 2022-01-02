<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBillingDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('billing_details', function(Blueprint $table)
		{
			$table->foreign('user_id', 'userID_ibfk_6')->references('id')->on('user_login')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('billing_details', function(Blueprint $table)
		{
			$table->dropForeign('userID_ibfk_6');
		});
	}

}
