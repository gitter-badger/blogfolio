<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPortfoliosDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('portfolios_data', function(Blueprint $table)
		{
			$table->foreign('portfolio_id', 'portfolio_id_key')->references('id')->on('portfolios')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('portfolios_data', function(Blueprint $table)
		{
			$table->dropForeign('portfolio_id_key');
		});
	}

}
