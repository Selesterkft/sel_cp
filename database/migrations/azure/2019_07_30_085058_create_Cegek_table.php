<?php

/*
 * Generating command:
 * php artisan migrate:generate Cegek --connection="azure"
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCegekTable extends Migration
{
    private $table, $connection;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection($this->connection)
            ->create($this->table, function(Blueprint $table)
		{
			$table->integer('ID')->primary('PK_Cegek');
			$table->integer('TransactID');
			$table->integer('SzamlazasiCim')->default(0);
			$table->integer('SzCimTipus')->default(0);
			$table->string('Nyitvatartas', 30)->default('');
			$table->string('RovidNev', 20)->default('')->index('IX_Cegek_RovidNev');
			$table->string('Nev1', 100)->index('Nev1');
			$table->string('Nev2', 50)->default('');
			$table->string('Cust_Old_Name', 100)->default('');
			$table->integer('Country_ID')->default(0);
			$table->string('Orszag', 3)->default('');
			$table->string('State', 10)->default('');
			$table->string('ISZ', 12)->default('');
			$table->string('District', 24)->default('');
			$table->string('Varos', 50)->default('');
			$table->string('Utca', 100)->default('');
			$table->string('Addr_ps_type', 24)->default('');
			$table->string('Addr_housenr', 24)->default('');
			$table->string('Addr_building', 24)->default('');
			$table->string('Addr_stairway', 24)->default('');
			$table->string('Addr_floor', 24)->default('');
			$table->string('Addr_door', 24)->default('');
			$table->string('Spec_Addr')->default('');
			$table->string('SzNev1', 100)->default('');
			$table->string('SzNev2', 50)->default('');
			$table->integer('Inv_Country_ID')->default(0);
			$table->string('SzOrszag', 3)->default('');
			$table->string('SzState', 10)->default('');
			$table->string('SzISZ', 12)->default('');
			$table->string('Inv_Addr_District', 24)->default('');
			$table->string('SzVaros', 50)->default('');
			$table->string('SzUtca', 100)->default('');
			$table->string('Inv_Addr_ps_type', 24)->default('');
			$table->string('Inv_Addr_housenr', 24)->default('');
			$table->string('Inv_Addr_building', 24)->default('');
			$table->string('Inv_Addr_stairway', 24)->default('');
			$table->string('Inv_Addr_floor', 24)->default('');
			$table->string('Inv_Addr_door', 24)->default('');
			$table->string('Inv_Spec_Addr')->default('');
			$table->integer('Fopartner')->default(0);
			$table->integer('RaktarFopartner')->default(0);
			$table->integer('Mail_Country_ID')->default(0);
			$table->string('LevelcimOrszag', 3)->default('');
			$table->string('LevelcimState', 10)->default('');
			$table->string('LevelcimISZ', 12)->default('');
			$table->string('Mail_Addr_District', 24)->default('');
			$table->string('LevelcimVaros', 50)->default('');
			$table->string('LevelcimUtca', 100)->default('');
			$table->string('Mail_Addr_ps_type', 24)->default('');
			$table->string('Mail_Addr_housenr', 24)->default('');
			$table->string('Mail_Addr_building', 24)->default('');
			$table->string('Mail_Addr_stairway', 24)->default('');
			$table->string('Mail_Addr_floor', 24)->default('');
			$table->string('Mail_Addr_door', 24)->default('');
			$table->string('Mail_Spec_Addr')->default('');
			$table->string('Adoszam', 20)->default('')->index('IX_Cegek_Adoszam');
			$table->string('EURAdoszam', 50)->default('');
			$table->string('LicenseNumber', 50)->default('');
			$table->string('PenzforgJelz', 12)->default('');
			$table->string('Szlaszam', 50)->default('');
			$table->string('IBANCode', 70)->default('');
			$table->string('SWIFT', 20)->default('');
			$table->integer('BANK_ACC_ID')->default(0);
			$table->string('Telefon1', 24)->default('');
			$table->string('Telefon2', 24)->default('');
			$table->string('Telefon3', 24)->default('');
			$table->string('Fax1', 24)->default('');
			$table->string('Fax2', 24)->default('');
			$table->string('Skype', 128)->default('');
			$table->string('OtherCommunication', 128)->default('');
			$table->string('Modem', 24)->default('');
			$table->string('eMail', 50)->default('');
			$table->string('Internet')->default('');
			$table->integer('PartnerOsztaly')->default(0)->index('PartnerOsztaly');
			$table->string('M2MC', 10)->default('');
			$table->dateTime('M2UtolsoValtoztatas')->nullable();
			$table->dateTime('InCorporation_Date')->nullable();
			$table->float('Annual_Revenue', 53, 0)->default(0);
			$table->integer('Annual_Revenue_Curr_ID')->default(0);
			$table->dateTime('First_Order_Date')->nullable();
			$table->dateTime('First_Offer_Requested')->nullable();
			$table->dateTime('Offer_Released')->nullable();
			$table->float('Insurance_max', 53, 0)->default(0);
			$table->integer('Insurance_Max_Curr_ID')->default(0);
			$table->integer('NumberOfEmployees')->default(0);
			$table->integer('FIBUKontoKred')->default(0);
			$table->integer('FIBUKontoDeb')->default(0);
			$table->string('Sprache', 3)->default('');
			$table->integer('ClassID1')->default(0);
			$table->integer('Wahrung')->default(0);
			$table->integer('ArfCode')->default(0);
			$table->integer('TeljDatumCode1')->default(0);
			$table->integer('TeljDatumCode3')->default(0);
			$table->integer('Credit_Payment_Deadline_Type')->default(0);
			$table->integer('Debit_Payment_Deadline_Type')->default(0);
			$table->integer('FizHat1')->default(0);
			$table->integer('FizMod')->default(0);
			$table->integer('FizHat2')->default(0);
			$table->integer('FizMod2')->default(0);
			$table->integer('ClassID2')->default(0);
			$table->integer('Wahrung2')->default(0);
			$table->integer('ArfCode2')->default(0);
			$table->integer('TeljDatumCode2')->default(0);
			$table->integer('TeljDatumCode4')->default(0);
			$table->integer('ISOpontszam')->default(0);
			$table->string('UgyfelJeleKonyvelesben', 30)->default('');
			$table->boolean('MegbizoIN')->default(0);
			$table->boolean('AlvallalkozoIN')->default(0);
			$table->boolean('PSpedIN')->default(0);
			$table->boolean('CimIN')->default(0);
			$table->string('Megjegyzesek')->default('');
			$table->integer('SajatCegPartnerID')->default(0);
			$table->string('TelepNev1', 100)->default('');
			$table->string('TelepNev2', 50)->default('');
			$table->integer('Site_Country_ID')->default(0);
			$table->string('TelepOrszag', 3)->default('');
			$table->string('TelepState', 10)->default('');
			$table->string('TelepISZ', 12)->default('');
			$table->string('Site_Addr_District', 24)->default('');
			$table->string('TelepVaros', 50)->default('');
			$table->string('TelepUtca', 100)->default('');
			$table->string('Site_Addr_ps_type', 24)->default('');
			$table->string('Site_Addr_housenr', 24)->default('');
			$table->string('Site_Addr_building', 24)->default('');
			$table->string('Site_Addr_stairway', 24)->default('');
			$table->string('Site_Addr_floor', 24)->default('');
			$table->string('Site_Addr_door', 24)->default('');
			$table->string('Site_Spec_Addr')->default('');
			$table->string('MCFremdsystem1', 20)->default('');
			$table->string('MCFremdsystem2', 20)->default('');
			$table->string('Zona', 5)->default('');
			$table->integer('CL_Category_ID')->default(0);
			$table->boolean('CL_Mon_Calc')->default(0);
			$table->boolean('CL_Mon_Inv')->default(0);
			$table->boolean('CL_Mon_Inv_Exp')->default(0);
			$table->boolean('CL_Mon_Cost')->default(0);
			$table->float('CreditOsszegHUF', 53, 0)->default(0);
			$table->float('CreditOsszegEUR', 53, 0)->default(0);
			$table->integer('CL_ModifiedBy')->default(0);
			$table->dateTime('CL_ModificationDate')->nullable();
			$table->float('Discount', 53, 0)->default(0);
			$table->integer('Inv_FormatID')->default(0);
			$table->boolean('UseOwnTariff')->default(0);
			$table->integer('M2UtolsoValtoztatas_UserID')->nullable();
			$table->integer('Felvevo_UserID')->nullable();
			$table->dateTime('Felvetel_Datuma')->nullable();
			$table->string('RefNum01', 50)->default('');
			$table->string('RefNum02', 50)->default('');
			$table->string('RefNum03', 50)->default('');
			$table->integer('Parent_Company_ID')->default(0);
			$table->integer('Corporate_Group_ID')->default(0)->index('IX_Cegek_Corporate_Group_ID');
			$table->integer('Taxpayer_Type')->default(0);
			$table->integer('ZusatzInt01')->default(0);
			$table->integer('ZusatzInt02')->default(0);
			$table->integer('ZusatzInt03')->default(0);
			$table->integer('ZusatzInt04')->default(0);
			$table->integer('ZusatzInt05')->default(0);
			$table->integer('ZusatzInt06')->default(0);
			$table->integer('ZusatzInt07')->default(0);
			$table->integer('ZusatzInt08')->default(0);
			$table->integer('ZusatzInt09')->default(0);
			$table->integer('ZusatzInt10')->default(0);
			$table->integer('ZusatzInt11')->default(0);
			$table->integer('ZusatzInt12')->default(0);
			$table->float('ZusatzFloat01', 53, 0)->default(0);
			$table->float('ZusatzFloat02', 53, 0)->default(0);
			$table->float('ZusatzFloat03', 53, 0)->default(0);
			$table->float('ZusatzFloat04', 53, 0)->default(0);
			$table->float('ZusatzFloat05', 53, 0)->default(0);
			$table->float('ZusatzFloat06', 53, 0)->default(0);
			$table->float('ZusatzFloat07', 53, 0)->default(0);
			$table->float('ZusatzFloat08', 53, 0)->default(0);
			$table->float('ZusatzFloat09', 53, 0)->default(0);
			$table->float('ZusatzFloat10', 53, 0)->default(0);
			$table->string('ZusatzVarchar01', 50)->default('');
			$table->string('ZusatzVarchar02', 50)->default('');
			$table->string('ZusatzVarchar03', 50)->default('');
			$table->string('ZusatzVarchar04', 50)->default('');
			$table->string('ZusatzVarchar05', 50)->default('');
			$table->string('ZusatzVarchar06', 50)->default('');
			$table->string('ZusatzVarchar07', 50)->default('');
			$table->string('ZusatzVarchar08', 50)->default('');
			$table->string('ZusatzVarchar09', 50)->default('');
			$table->string('ZusatzVarchar10', 50)->default('');
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
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection($this->connection)
            ->dropIfExists($this->table);
	}

    /**
     * CreateAlkalmazottakTable constructor.
     * @param $table
     */
    public function __construct()
    {
        $config = config('appConfig.tables')['cegek'];
        $this->table = $config['name'];
        $this->connection = $config['connection'];
    }
}
