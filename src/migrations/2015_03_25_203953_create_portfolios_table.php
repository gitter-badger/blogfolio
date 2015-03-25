<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePortfoliosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portfolios', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable()->index('nameIndex');
			$table->string('image')->nullable();
			$table->boolean('status')->nullable();
			$table->boolean('use_skills')->nullable();
			$table->string('skills')->nullable();
			$table->string('projects')->nullable();
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
		Schema::drop('portfolios');
	}

}
