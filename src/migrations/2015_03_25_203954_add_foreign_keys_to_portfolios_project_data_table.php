<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPortfoliosProjectDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('portfolios_project_data', function(Blueprint $table)
		{
			$table->foreign('project_id', 'portfolios_project_data_ibfk_2')->references('id')->on('portfolios_project')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('portfolios_project_data', function(Blueprint $table)
		{
			$table->dropForeign('portfolios_project_data_ibfk_2');
		});
	}

}
