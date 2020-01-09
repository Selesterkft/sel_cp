<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBorderoMegbTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('azure')->create('BorderoMegb', function(Blueprint $table)
		{
			$table->integer('ID')->default(0)->primary('PK_BorderoMegb');
			$table->integer('TransactID')->nullable();
			$table->integer('BorderoID')->nullable()->default(0)->index('BorderoID');
			$table->integer('Alsorszam')->nullable()->default(0)->index('Alsorszam');
			$table->string('EvidNr_1', 20)->nullable();
			$table->string('EvidNr_2', 10)->nullable();
			$table->string('EvidNr_3', 10)->nullable();
			$table->string('EvidNr_Slash', 3)->nullable();
			$table->string('EvidNr_Stage', 3)->nullable();
			$table->integer('Evid_Stage_SeqNr')->nullable();
			$table->integer('Evid_Parent_Stage_ID')->nullable()->index('Evid_Parent_Stage_ID');
			$table->string('EvidNrInOneField', 25)->nullable();
			$table->integer('Fictive_Ord_ID')->nullable();
			$table->integer('ORD_L_Type')->nullable();
			$table->integer('Evid_Root_ORD_L_ID')->nullable()->index('Evid_Root_ORD_L_ID');
			$table->integer('Evid_Parent_ORD_L_ID')->nullable()->index('IX_BorderoMegb_evid_parent_ord_l_id');
			$table->string('URefNr_1', 20)->nullable()->index('IX_BorderoMegb_URefNr_1');
			$table->string('URefNr_2', 10)->nullable();
			$table->string('URefNr_3', 10)->nullable();
			$table->string('URefNr_4', 10)->nullable();
			$table->string('URefNr_5', 10)->nullable();
			$table->integer('MegbID')->nullable()->default(0);
			$table->string('MegbNev1', 100)->nullable();
			$table->string('MegbNev2', 50)->nullable();
			$table->string('MegbUtca', 100)->nullable();
			$table->string('MegbOrszag', 3)->nullable();
			$table->string('MegbState', 10)->nullable();
			$table->string('MegbISZ', 12)->nullable();
			$table->string('MegbHelyseg', 50)->nullable();
			$table->float('MegbFuvDij', 53, 0)->nullable()->default(0);
			$table->integer('MegbFuvDijDev')->nullable()->default(0);
			$table->float('MegbFuvDijBelf', 53, 0)->nullable()->default(0);
			$table->char('MegbFuvDijArfCode', 1)->nullable();
			$table->string('MegbFuvDijMegj')->nullable();
			$table->integer('MegbKontaktID')->nullable()->default(0);
			$table->string('MegKontakt', 50)->nullable();
			$table->string('MegbTel', 24)->nullable();
			$table->string('MegbFax', 24)->nullable();
			$table->string('MegbEMail', 50)->nullable();
			$table->string('MegbMegj')->nullable();
			$table->string('Goods_Remarks')->nullable();
			$table->integer('MegbFizNap')->nullable()->default(0);
			$table->string('MegrendelesSzam', 50)->nullable()->index('MegrendelesSzam');
			$table->integer('AlvID')->nullable()->default(0)->index('AlvID');
			$table->string('AlvNev1', 100)->nullable();
			$table->string('AlvNev2', 50)->nullable();
			$table->string('AlvUtca', 100)->nullable();
			$table->string('AlvOrszag', 3)->nullable();
			$table->string('AlvState', 10)->nullable();
			$table->string('AlvISZ', 12)->nullable();
			$table->string('AlvHelyseg', 50)->nullable();
			$table->integer('AlvKontaktID')->nullable()->default(0);
			$table->string('AlvKontakt', 50)->nullable();
			$table->string('AlvFax', 24)->nullable();
			$table->string('AlvTel', 24)->nullable();
			$table->string('AlvEMail', 50)->nullable();
			$table->float('AlvFuvDij', 53, 0)->nullable()->default(0);
			$table->integer('AlvFuvDijDev')->nullable()->default(0);
			$table->string('AlvFuvDijMegj', 20)->nullable();
			$table->string('AlvMegj')->nullable();
			$table->integer('AlvJvezID')->nullable()->default(0);
			$table->string('AlvJvez', 50)->nullable();
			$table->string('AlvJvezIgazolvanyszam', 20)->nullable();
			$table->string('P23_Driver_Tel', 50)->nullable();
			$table->string('P23_Driver_Email', 50)->nullable();
			$table->string('P23_Driver_Skype', 50)->nullable();
			$table->string('P23_Driver_Remarks')->nullable();
			$table->integer('TGK_ID')->nullable()->default(0);
			$table->string('Rendszam', 20)->nullable();
			$table->string('TGKTipus', 30)->nullable();
			$table->integer('PKCS_ID')->nullable()->default(0);
			$table->string('PKCS_Rendszam', 20)->nullable();
			$table->string('PKCS_Tipus', 30)->nullable();
			$table->string('NyomtatasiJelek', 20)->nullable();
			$table->integer('ParitasID')->nullable()->default(0)->index('ParitasID');
			$table->string('Paritas', 4)->nullable();
			$table->string('ParitasHelyseg')->nullable();
			$table->string('Rel1', 10)->nullable();
			$table->string('Rel2', 10)->nullable();
			$table->string('Rel3', 10)->nullable();
			$table->integer('TulajdonosUserID')->default(0)->index('TulajdonosUserID');
			$table->string('FelhMezo1', 30)->nullable();
			$table->string('FelhMezo2', 30)->nullable();
			$table->string('FelhMezo3', 30)->nullable();
			$table->string('FelhMezo4', 30)->nullable();
			$table->string('FelhMezo5', 30)->nullable();
			$table->string('FelhMezo6', 30)->nullable();
			$table->integer('FelrakVamID')->nullable()->default(0)->index('FelrakVamID');
			$table->string('FelrakVamNev1', 100)->nullable();
			$table->string('FelrakVamNev2', 50)->nullable();
			$table->string('FelrakVamUtca', 100)->nullable();
			$table->string('FelrakVamOrszag', 3)->nullable();
			$table->string('FelrakVamState', 10)->nullable();
			$table->string('FelrakVamISZ', 12)->nullable();
			$table->string('FelrakVamHelyseg', 50)->nullable();
			$table->string('FelrakVamMegj')->nullable();
			$table->integer('LerakVamID')->nullable()->default(0)->index('LerakVamID');
			$table->string('LerakVamNev1', 100)->nullable();
			$table->string('LerakVamNev2', 50)->nullable();
			$table->string('LerakVamUtca', 100)->nullable();
			$table->string('LerakVamOrszag', 3)->nullable();
			$table->string('LerakVamState', 10)->nullable();
			$table->string('LerakVamISZ', 12)->nullable();
			$table->string('LerakVamHelyseg', 50)->nullable();
			$table->string('LerakVamMegj')->nullable();
			$table->integer('FeladoID')->nullable()->default(0)->index('MegbID');
			$table->string('FeladoNev1', 100)->nullable()->index('IX_BorderoMegb_FeladoNev1');
			$table->string('FeladoNev2', 50)->nullable();
			$table->string('FeladoUtca', 100)->nullable();
			$table->string('FeladoOrszag', 3)->nullable();
			$table->string('FeladoState', 10)->nullable();
			$table->string('FeladoISZ', 12)->nullable();
			$table->string('FeladoHelyseg', 50)->nullable();
			$table->integer('CimzettID')->nullable()->default(0)->index('FeladoID');
			$table->string('CimzettNev1', 100)->nullable()->index('IX_BorderoMegb_CimzettNev1');
			$table->string('CimzettNev2', 50)->nullable();
			$table->string('CimzettUtca', 100)->nullable();
			$table->string('CimzettOrszag', 3)->nullable();
			$table->string('CimzettState', 10)->nullable();
			$table->string('CimzettISZ', 12)->nullable();
			$table->string('CimzettHelyseg', 50)->nullable();
			$table->integer('Sped3ID')->nullable()->default(0)->index('Sped3ID');
			$table->string('Sped3Nev1', 100)->nullable();
			$table->string('Sped3Nev2', 50)->nullable();
			$table->string('Sped3Utca', 100)->nullable();
			$table->string('Sped3Orszag', 3)->nullable();
			$table->string('Sped3State', 10)->nullable();
			$table->string('Sped3ISZ', 12)->nullable();
			$table->string('Sped3Helyseg', 50)->nullable();
			$table->dateTime('VamDatum')->nullable();
			$table->dateTime('KiszallDatum')->nullable();
			$table->dateTime('FelrakDatum')->nullable();
			$table->dateTime('LerakDatum')->nullable();
			$table->string('SzlaInstrukcio')->nullable();
			$table->integer('StatusID')->nullable()->default(0)->index('StatusID');
			$table->dateTime('FelrakDatumIG')->nullable();
			$table->dateTime('LerakDatumIG')->nullable();
			$table->dateTime('Date1')->nullable();
			$table->dateTime('Date2')->nullable();
			$table->string('Nyitvatartas', 30)->nullable();
			$table->boolean('Direct')->default(0);
			$table->boolean('Vinculalt')->default(0);
			$table->dateTime('KiszallFelrakDatum')->nullable();
			$table->dateTime('KiszallFelrakDatumIG')->nullable();
			$table->dateTime('KiszallDatumIG')->nullable();
			$table->dateTime('FelvetelDatumMegb')->nullable();
			$table->dateTime('UtolsoModDatumMegb')->nullable();
			$table->integer('BordMegbOsszKM')->nullable()->default(0);
			$table->integer('BordMegbRakottKM')->nullable()->default(0);
			$table->integer('BordMegbUresKM')->nullable()->default(0);
			$table->integer('BordMegbUresKM2')->nullable()->default(0);
			$table->integer('BordMegbKezdoKM')->nullable()->default(0);
			$table->integer('BordMegbVegKM')->nullable()->default(0);
			$table->string('Zona', 5)->nullable();
			$table->string('BordMegbDok1', 50)->nullable();
			$table->string('BordMegbDok2', 50)->nullable();
			$table->string('BordMegbDok3', 50)->nullable();
			$table->string('BordMegbDok4', 50)->nullable();
			$table->string('BordMegbDok5', 50)->nullable();
			$table->string('EKAER', 50)->nullable();
			$table->string('BordNrInEinFeld', 20)->nullable()->index('BordNrInEinFeld');
			$table->string('PosNrInEinFeld', 25)->nullable()->index('PosNrInEinFeld');
			$table->integer('MegbStatusFlags')->nullable();
			$table->integer('MegbStatusJelleg')->nullable();
			$table->integer('BordMegbKM')->nullable();
			$table->integer('LgrBewID')->nullable()->index('LgrBewID');
			$table->integer('ProcessCode01')->nullable();
			$table->integer('ProcessCode02')->nullable();
			$table->integer('ProcessCode03')->nullable();
			$table->integer('Closed')->nullable();
			$table->boolean('Manually')->default(0);
			$table->float('PayOnDelivery_Amount', 53, 0)->nullable();
			$table->integer('PayOnDelivery_Curr_ID')->nullable();
			$table->boolean('PayOnDelivery_Paid')->nullable();
			$table->string('PayOnDelivery_Descr')->nullable();
			$table->dateTime('PayOnDelivery_Incoming_Date')->nullable();
			$table->integer('PayOnDelivery_Bank_L_ID')->nullable();
			$table->boolean('Insurance_YN')->nullable();
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
		Schema::connection('azure')->drop('BorderoMegb');
	}

}
