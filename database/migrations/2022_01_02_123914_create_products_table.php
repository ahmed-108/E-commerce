<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('sub_category_id');
			$table->integer('category_id')->index('category_ibfk_1');
			$table->string('title', 1000);
			$table->string('short_description', 1000);
			$table->string('long_description', 10000);
			$table->integer('price');
			$table->integer('product_imagesID')->nullable()->index('product_imagesID');
			$table->integer('old_price')->nullable();
			$table->integer('discount')->nullable();
			$table->timestamps(10);
			$table->index(['sub_category_id','category_id'], 'sub_category_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
