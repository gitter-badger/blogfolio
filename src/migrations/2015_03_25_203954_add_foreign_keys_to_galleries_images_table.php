<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGalleriesImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('galleries_images', function(Blueprint $table)
		{
			$table->foreign('gallery_id', 'gallery_id')->references('id')->on('galleries')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('galleries_images', function(Blueprint $table)
		{
			$table->dropForeign('gallery_id');
		});
	}

}
