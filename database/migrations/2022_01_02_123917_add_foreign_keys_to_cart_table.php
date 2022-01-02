<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cart', function(Blueprint $table)
		{
			$table->foreign('product_id', 'product_ibfk_1')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'user_ibfk_2')->references('id')->on('user_login')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cart', function(Blueprint $table)
		{
			$table->dropForeign('product_ibfk_1');
			$table->dropForeign('user_ibfk_2');
		});
	}

}
