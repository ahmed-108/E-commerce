<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub-category', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->index('category_id');
			$table->string('sub_category_name', 1000);
			$table->dateTime('created_at')->nullable();
			$table->dateTime('updated_at')->nullable();				});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sub-category');
	}

}
