<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostsDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts_data', function(Blueprint $table)
		{
			$table->foreign('post_id', 'post_id_foreign')->references('id')->on('posts')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts_data', function(Blueprint $table)
		{
			$table->dropForeign('post_id_foreign');
		});
	}

}
