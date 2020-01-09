<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBorderoAlPozTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('azure')->create('BorderoAlPoz', function(Blueprint $table)
		{
			$table->integer('ID')->default(0)->primary('PK_BorderoAlPoz');
			$table->integer('TransactID')->nullable();
			$table->integer('Alsorszam')->nullable()->default(0);
			$table->integer('AruID')->nullable()->default(0)->index('AruID');
			$table->integer('BordID')->nullable()->default(0)->index('BordID');
			$table->integer('MegbID')->nullable()->default(0)->index('MegbID');
			$table->integer('TypID')->nullable()->default(1)->index('TypID');
			$table->string('HivatkozasiSzam', 20)->nullable();
			$table->integer('FelLeID')->nullable()->default(0)->index('FelLeID');
			$table->string('FelLeNev1', 100)->nullable()->index('FelLeNev1');
			$table->string('FelLeNev2', 50)->nullable();
			$table->string('FelLeUtca', 100)->nullable();
			$table->string('FelLeOrszag', 3)->nullable();
			$table->string('FelLeState', 10)->nullable();
			$table->string('FelLeISZ', 12)->nullable();
			$table->string('FelLeHelyseg', 50)->nullable();
			$table->string('FelLeAdoszam', 15)->nullable();
			$table->string('FelLeFaxszam', 25)->nullable();
			$table->string('FelLeMegj')->nullable()->default('');
			$table->dateTime('FelLeDatumTOL')->nullable();
			$table->dateTime('FelLeDatumIG')->nullable();
			$table->integer('StatusID')->nullable()->default(0);
			$table->integer('FelLeVamID')->nullable();
			$table->string('FelLeVamNev1', 100)->nullable();
			$table->string('FelLeVamNev2', 50)->nullable();
			$table->string('FelLeVamUtca', 100)->nullable();
			$table->string('FelLeVamOrszag', 3)->nullable();
			$table->string('FelLeVamState', 10)->nullable();
			$table->string('FelLeVamISZ', 12)->nullable();
			$table->string('FelLeVamHelyseg', 50)->nullable();
			$table->boolean('Direkt')->default(0);
			$table->integer('ZusatzInt01')->nullable();
			$table->integer('ZusatzInt02')->nullable();
			$table->integer('ZusatzInt03')->nullable();
			$table->integer('ZusatzInt04')->nullable();
			$table->integer('ZusatzInt05')->nullable();
			$table->integer('ZusatzInt06')->nullable();
			$table->integer('ZusatzInt07')->nullable();
			$table->integer('ZusatzInt08')->nullable();
			$table->integer('ZusatzInt09')->nullable();
			$table->integer('ZusatzInt10')->nullable();
			$table->float('ZusatzFloat01', 53, 0)->nullable();
			$table->float('ZusatzFloat02', 53, 0)->nullable();
			$table->float('ZusatzFloat03', 53, 0)->nullable();
			$table->float('ZusatzFloat04', 53, 0)->nullable();
			$table->float('ZusatzFloat05', 53, 0)->nullable();
			$table->float('ZusatzFloat06', 53, 0)->nullable();
			$table->float('ZusatzFloat07', 53, 0)->nullable();
			$table->float('ZusatzFloat08', 53, 0)->nullable();
			$table->float('ZusatzFloat09', 53, 0)->nullable();
			$table->float('ZusatzFloat10', 53, 0)->nullable();
			$table->dateTime('ZusatzDate01')->nullable();
			$table->dateTime('ZusatzDate02')->nullable();
			$table->dateTime('ZusatzDate03')->nullable();
			$table->dateTime('ZusatzDate04')->nullable();
			$table->dateTime('ZusatzDate05')->nullable();
			$table->dateTime('ZusatzDate06')->nullable();
			$table->dateTime('ZusatzDate07')->nullable();
			$table->dateTime('ZusatzDate08')->nullable();
			$table->dateTime('ZusatzDate09')->nullable();
			$table->dateTime('ZusatzDate10')->nullable();
			$table->string('ZusatzVarchar01', 50)->nullable();
			$table->string('ZusatzVarchar02', 50)->nullable();
			$table->string('ZusatzVarchar03', 50)->nullable();
			$table->string('ZusatzVarchar04', 50)->nullable();
			$table->string('ZusatzVarchar05', 50)->nullable();
			$table->string('ZusatzVarchar06', 50)->nullable();
			$table->string('ZusatzVarchar07', 50)->nullable();
			$table->string('ZusatzVarchar08', 50)->nullable();
			$table->string('ZusatzVarchar09', 50)->nullable();
			$table->string('ZusatzVarchar10', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('azure')->drop('BorderoAlPoz');
	}

}
