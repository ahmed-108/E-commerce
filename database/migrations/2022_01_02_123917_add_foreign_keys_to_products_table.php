<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->foreign('category_id', 'category_ibfk_1')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('product_imagesID', 'products_ibfk_1')->references('id')->on('product_images')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('sub_category_id', 'subcategory_ibfk_2')->references('id')->on('sub-category')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropForeign('category_ibfk_1');
			$table->dropForeign('products_ibfk_1');
			$table->dropForeign('subcategory_ibfk_2');
		});
	}

}
