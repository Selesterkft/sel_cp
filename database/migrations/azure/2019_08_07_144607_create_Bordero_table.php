<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBorderoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('azure')->create('Bordero', function(Blueprint $table)
		{
			$table->integer('ID')->default(0)->unique('Bordero_ID');
			$table->integer('TransactID')->nullable();
			$table->integer('HivatkozottBordID')->nullable()->default(0);
			$table->string('Offer_Num', 20)->nullable();
			$table->dateTime('Offer_Valid_FROM')->nullable();
			$table->dateTime('Offer_Valid_TO')->nullable();
			$table->integer('JaratID')->nullable()->default(0)->index('JaratID');
			$table->string('BordNr_1', 10)->nullable();
			$table->string('BordNr_2', 10)->nullable();
			$table->string('BordNr_3', 10)->nullable();
			$table->string('BordNr_4', 10)->nullable();
			$table->string('BordNr_5', 10)->nullable();
			$table->integer('Fictive')->default(0)->index('IX_Bordero_Fictive');
			$table->integer('ProcessCode_1')->nullable();
			$table->string('BejovoBordNr', 20)->nullable();
			$table->string('Megj')->nullable();
			$table->string('RefNr_1', 20)->nullable();
			$table->string('RefNr_2', 20)->nullable();
			$table->string('RefNr_3', 20)->nullable();
			$table->string('RefNr_4', 20)->nullable();
			$table->string('RefNr_5', 20)->nullable();
			$table->integer('Sped1ID')->nullable()->default(0);
			$table->string('Sped1Nev1', 100)->nullable();
			$table->string('Sped1Nev2', 50)->nullable();
			$table->string('Sped1Utca', 100)->nullable();
			$table->string('Sped1Orszag', 3)->nullable();
			$table->string('Sped1State', 10)->nullable();
			$table->string('Sped1ISZ', 12)->nullable();
			$table->string('Sped1Helyseg', 50)->nullable();
			$table->integer('Sped2ID')->nullable()->default(0);
			$table->string('Sped2Nev1', 100)->nullable();
			$table->string('Sped2Nev2', 50)->nullable();
			$table->string('Sped2Utca', 100)->nullable();
			$table->string('Sped2Orszag', 3)->nullable();
			$table->string('Sped2State', 10)->nullable();
			$table->string('Sped2ISZ', 12)->nullable();
			$table->string('Sped2Helyseg', 50)->nullable();
			$table->integer('FoAlvID')->nullable()->default(0)->index('FoAlvID');
			$table->string('FoAlvNev1', 100)->nullable();
			$table->string('FoAlvNev2', 50)->nullable();
			$table->string('FoAlvUtca', 100)->nullable();
			$table->string('FoAlvOrszag', 3)->nullable();
			$table->string('FoAlvState', 10)->nullable();
			$table->string('FoAlvISZ', 12)->nullable();
			$table->string('FoAlvHelyseg', 50)->nullable();
			$table->integer('FoAlvKontaktID')->nullable()->default(0);
			$table->string('FoAlvKontakt', 50)->nullable();
			$table->string('FoAlvFax', 24)->nullable();
			$table->string('FoAlvTel', 24)->nullable();
			$table->string('FoAlvEMail', 50)->nullable();
			$table->float('FoAlvFuvDij', 53, 0)->nullable()->default(0);
			$table->integer('FoAlvFuvDijDev')->nullable()->default(0);
			$table->float('FoAlvFuvDijBelf', 53, 0)->nullable()->default(0);
			$table->string('FoAlvFuvDijArfCode', 1)->nullable();
			$table->string('FoAlvFuvDijMegj', 20)->nullable();
			$table->integer('FoAlvFizNap')->nullable()->default(0);
			$table->integer('FoAlvJvezID')->nullable()->default(0);
			$table->string('FoAlvJvez', 50)->nullable();
			$table->string('P16_Driver_LicenseNum', 50)->nullable();
			$table->string('P16_Driver_Tel', 50)->nullable();
			$table->string('P16_Driver_Email', 50)->nullable();
			$table->string('P16_Driver_Skype', 50)->nullable();
			$table->string('P16_Driver_Remarks')->nullable();
			$table->string('FoAlvSzlaInstrukcio')->nullable();
			$table->integer('FoTGK_ID')->nullable()->default(0)->index('FoTGK_ID');
			$table->string('FoTGKRendszam', 20)->nullable();
			$table->string('FoTGKTipus', 100)->nullable();
			$table->float('FoTGK_liter', 53, 0)->nullable()->default(0);
			$table->integer('FoPKCS_ID')->nullable()->default(0)->index('FoPKCS_ID');
			$table->float('FoPKCS_liter', 53, 0)->nullable()->default(0);
			$table->string('FoPKCS_Rendszam', 20)->nullable();
			$table->string('FoPKCS_Tipus', 30)->nullable();
			$table->string('Rakjegyzekszam', 20)->nullable();
			$table->dateTime('Datum')->nullable();
			$table->dateTime('FelvetelDatum')->nullable()->index('IX_Bordero_FelvetelDatum');
			$table->integer('TulajdonosUserID')->nullable()->default(0)->index('TulajdonosUserID');
			$table->integer('UserID2')->nullable()->default(0);
			$table->integer('UserID3')->nullable()->default(0);
			$table->dateTime('UtolsoModDatum')->nullable();
			$table->string('FelhMezo1', 30)->nullable();
			$table->string('FelhMezo2', 30)->nullable();
			$table->string('FelhMezo3', 30)->nullable();
			$table->string('FelhMezo4', 30)->nullable();
			$table->string('FelhMezo5', 30)->nullable();
			$table->string('FelhMezo6', 30)->nullable();
			$table->dateTime('Datum1')->nullable()->index('Datum1');
			$table->dateTime('Datum2')->nullable()->index('Datum2');
			$table->dateTime('Datum3')->nullable()->index('Datum3');
			$table->dateTime('Datum4')->nullable()->index('Datum4');
			$table->dateTime('Datum5')->nullable();
			$table->string('Homerseklet', 20)->nullable();
			$table->integer('FVamID')->nullable()->default(0);
			$table->string('FVamNev1', 100)->nullable();
			$table->string('FVamNev2', 50)->nullable();
			$table->string('FVamUtca', 100)->nullable();
			$table->string('FVamOrszag', 3)->nullable();
			$table->string('FVamState', 10)->nullable();
			$table->string('FVamISZ', 12)->nullable();
			$table->string('FVamHelyseg', 50)->nullable();
			$table->integer('LVamID')->nullable()->default(0);
			$table->string('LVamNev1', 100)->nullable();
			$table->string('LVamNev2', 50)->nullable();
			$table->string('LVamUtca', 100)->nullable();
			$table->string('LVamOrszag', 3)->nullable();
			$table->string('LVamState', 10)->nullable();
			$table->string('LVamISZ', 12)->nullable();
			$table->string('LVamHelyseg', 50)->nullable();
			$table->integer('OsszKM')->nullable()->default(0);
			$table->integer('RakottKM')->nullable()->default(0);
			$table->integer('UresKM')->nullable()->default(0);
			$table->integer('UresKM2')->nullable()->default(0);
			$table->integer('KezdoKM')->nullable()->default(0);
			$table->integer('VegKM')->nullable()->default(0);
			$table->string('Megj1')->nullable();
			$table->string('Rel1', 10)->nullable()->index('IX_Bordero_Rel1');
			$table->string('Rel2', 10)->nullable();
			$table->string('Rel3', 10)->nullable();
			$table->integer('StatusID')->nullable()->default(0)->index('StatusID');
			$table->integer('FoMegbID')->nullable()->default(0)->index('FoMegbID');
			$table->string('FoMegbNev1', 100)->nullable();
			$table->string('FoMegbNev2', 50)->nullable();
			$table->string('FoMegbUtca', 100)->nullable();
			$table->string('FoMegbOrszag', 3)->nullable();
			$table->string('FoMegbState', 10)->nullable();
			$table->string('FoMegbISZ', 12)->nullable();
			$table->string('FoMegbHelyseg', 50)->nullable();
			$table->integer('FoMegbKontaktID')->nullable()->default(0);
			$table->string('FoMegbKontakt', 50)->nullable();
			$table->string('FoMegbFax', 24)->nullable();
			$table->string('FoMegbTel', 24)->nullable();
			$table->string('FoMegbEMail', 50)->nullable();
			$table->float('FoMegbFuvDij', 53, 0)->nullable()->default(0);
			$table->integer('FoMegbFuvDijDev')->nullable()->default(0);
			$table->string('FoMegbFuvDijMegj', 20)->nullable();
			$table->string('FoMegbMegrendelesSzam', 20)->nullable();
			$table->string('FoMegbSzlaInstrukcio')->nullable();
			$table->string('SchiffName', 30)->nullable();
			$table->dateTime('SchiffAbfahrt')->nullable();
			$table->dateTime('SchiffAnkunft')->nullable();
			$table->string('VoyageNr', 50)->nullable();
			$table->string('BordDok1', 12)->nullable();
			$table->string('BordDok2', 20)->nullable();
			$table->string('BordDok3', 20)->nullable();
			$table->string('BordDok4', 20)->nullable();
			$table->string('BordDok5', 20)->nullable();
			$table->dateTime('Datum6')->nullable();
			$table->dateTime('Datum7')->nullable();
			$table->dateTime('Datum8')->nullable();
			$table->string('BordZona', 5)->nullable();
			$table->string('BordNrInEinFeld', 20)->nullable()->index('BordNrInEinFeld');
			$table->integer('BordStatusFlags')->nullable();
			$table->boolean('Closed')->default(0);
			$table->integer('ClosedUserID')->nullable();
			$table->integer('Period')->nullable()->index('Period');
			$table->integer('ParitasID')->nullable();
			$table->string('Paritas', 4)->nullable();
			$table->string('ParitasHelyseg', 30)->nullable();
			$table->string('ContainerType', 20)->nullable();
			$table->string('ContainerNum', 50)->nullable();
			$table->string('MrnNum', 50)->nullable();
			$table->boolean('Manually')->default(0);
			$table->integer('Type_of_cost_allocation')->nullable();
			$table->string('TemplateName', 50)->nullable();
			$table->integer('Vhcl_TypeID')->nullable();
			$table->float('Vhcl_MaxVolume', 53, 0)->nullable();
			$table->float('Vhcl_MaxWeight', 53, 0)->nullable();
			$table->float('Vhcl_FloorSpace', 53, 0)->nullable();
			$table->string('Internal_Remarks')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('azure')->drop('Bordero');
	}

}
