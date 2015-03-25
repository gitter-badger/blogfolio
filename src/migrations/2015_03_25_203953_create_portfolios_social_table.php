<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePortfoliosSocialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portfolios_social', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('portfolio_id')->nullable()->index('portfolio');
			$table->string('name')->nullable();
			$table->string('link')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('portfolios_social');
	}

}
