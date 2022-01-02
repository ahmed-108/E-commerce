<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comments', function(Blueprint $table)
		{
			$table->foreign('product_id', 'product_ibfk_2')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'userID_ibfk_1')->references('id')->on('user_login')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comments', function(Blueprint $table)
		{
			$table->dropForeign('product_ibfk_2');
			$table->dropForeign('userID_ibfk_1');
		});
	}

}
