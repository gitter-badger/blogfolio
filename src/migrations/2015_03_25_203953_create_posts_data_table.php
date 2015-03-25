<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts_data', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('post_id')->unsigned()->index('post_id_foreign');
			$table->string('lang', 6);
			$table->text('content', 65535);
			$table->string('title');
			$table->string('slug');
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
		Schema::drop('posts_data');
	}

}
