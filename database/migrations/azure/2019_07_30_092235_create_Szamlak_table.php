<?php

/*
 * Generating command:
 * php artisan migrate:generate Szamlak --connection="azure"
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSzamlakTable extends Migration
{
    private $connection, $_table;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('azure')->create('Szamlak', function(Blueprint $table)
		{
			$table->integer('ID')->default(0)->primary('PK_Szamlak');
			$table->integer('TransactID')->default(0);
			$table->string('SzlaSzam', 25)->index('SzlaSzam');
			$table->integer('StornoSorszam');
			$table->integer('LongReNr')->index('IX_Szamlak_LongReNr');
			$table->integer('Iktatosorszam')->default(0)->index('Iktatosorszam');
			$table->integer('Period')->default(0)->index('IX_Szamlak_Period');
			$table->integer('TipusID')->default(0)->index('IX_Szamlak_TipusID');
			$table->integer('Ref_Szamlak_ID')->index('IX_Szamlak_Ref_Szamlak_ID');
			$table->integer('Parent_INV_ID')->index('IX_Szamlak_Parent_INV_ID');
			$table->integer('Current_Valid_Correction_Note_ID')->default(0);
			$table->integer('Allapot')->default(0);
			$table->integer('FormatID')->default(0);
			$table->boolean('Gedruckt')->default(0);
			$table->boolean('StornoGedruckt')->default(0);
			$table->dateTime('StornoDatum')->nullable();
			$table->integer('Cancellation_ReasonCode')->default(0);
			$table->string('Cancellation_ReasonText')->default('');
			$table->boolean('AbschlussJN')->default(0);
			$table->string('Szoveg', 50);
			$table->integer('SzallitoKod')->default(0)->index('SzallitoKod');
			$table->string('SzallitoNev1', 100);
			$table->string('SzallitoNev2', 50);
			$table->string('SzallitoOrszag', 3);
			$table->string('SzallitoState', 10);
			$table->string('SzallitoISZ', 12);
			$table->string('Vendor_Addr_District', 24);
			$table->string('SzallitoVaros', 50);
			$table->string('SzallitoUtca', 100);
			$table->string('Vendor_Addr_ps_type', 24);
			$table->string('Vendor_Addr_housenr', 24);
			$table->string('Vendor_Addr_building', 24);
			$table->string('Vendor_Addr_stairway', 24);
			$table->string('Vendor_Addr_floor', 24);
			$table->string('Vendor_Addr_door', 24);
			$table->string('SzallitoAdoszam', 20);
			$table->string('SzallitoEURAdoszam', 50);
			$table->string('SzallitoPenzforgJelz', 12);
			$table->string('SzallitoSzlaszam', 26);
			$table->string('SzallitoIBANCode', 70);
			$table->integer('FIBUKontoKred')->default(0);
			$table->integer('VevoKod')->default(0)->index('VevoKod');
			$table->string('VevoNev1', 100);
			$table->string('VevoNev2', 50);
			$table->string('VevoOrszag', 3);
			$table->string('VevoState', 10);
			$table->string('VevoISZ', 12);
			$table->string('Customer_Addr_District', 24);
			$table->string('VevoVaros', 50);
			$table->string('VevoUtca', 100);
			$table->string('Customer_Addr_ps_type', 24);
			$table->string('Customer_Addr_housenr', 24);
			$table->string('Customer_Addr_building', 24);
			$table->string('Customer_Addr_stairway', 24);
			$table->string('Customer_Addr_floor', 24);
			$table->string('Customer_Addr_door', 24);
			$table->string('VevoAdoszam', 20);
			$table->string('VevoEURAdoszam', 50);
			$table->string('VevoPenzforgJelz', 12);
			$table->string('VevoSzlaszam', 26);
			$table->string('VevoIBANCode', 70);
			$table->integer('FIBUKontoDeb')->default(0);
			$table->integer('BankkontoID')->default(0);
			$table->integer('ClassID');
			$table->dateTime('Period_FROM')->nullable();
			$table->dateTime('Period_TO')->nullable();
			$table->dateTime('Kelte')->index('IX_Szamlak_Kelte');
			$table->dateTime('Teljesitve')->index('IX_Szamlak_Teljesitve');
			$table->integer('Curr_Dates_Method');
			$table->dateTime('ArfDatum')->nullable()->index('IX_Szamlak_ArfDatum');
			$table->dateTime('KonyvelesiDatum')->index('IX_Szamlak_KonyvelesiDatum');
			$table->integer('FizMod')->default(0);
			$table->dateTime('Lejarat')->index('IX_Szamlak_Lejarat');
			$table->dateTime('BeerkezesDatum')->index('IX_Szamlak_BeerkezesDatum');
			$table->dateTime('BejovoSzlaLejarat')->index('IX_Szamlak_BejovoSzlaLejarat');
			$table->float('NetOsszesen', 53, 0);
			$table->float('AFAOsszesen', 53, 0);
			$table->float('BruttoOsszesen', 53, 0);
			$table->integer('FizAllapot')->default(0)->index('IX_Szamlak_FizAllapot');
			$table->dateTime('Fully_paid_date')->nullable()->index('IX_Szamlak_Fully_paid_date');
			$table->float('EddigKifizetve', 53, 0)->default(0);
			$table->float('EddigKifizetveEUR', 53, 0)->default(0);
			$table->float('EddigKifizetveFIBU', 53, 0)->default(0);
			$table->float('FWGesamtNet', 53, 0)->default(0);
			$table->float('FWGesamtMwSt', 53, 0)->default(0);
			$table->float('FWGesamtBrutto', 53, 0)->default(0);
			$table->string('SzamlaNyelve', 3);
			$table->integer('Wahrung')->index('IX_Szamlak_Wahrung');
			$table->float('EURNet', 53, 0)->default(0);
			$table->float('EURMwSt', 53, 0)->default(0);
			$table->float('EURBrutto', 53, 0)->default(0);
			$table->string('Bemerkung')->nullable();
			$table->string('Mellekletek')->nullable();
			$table->dateTime('FelvDatum')->nullable()->index('IX_Szamlak_FelvDatum');
			$table->integer('FelvUserID')->default(0);
			$table->string('SzlaFeladInfo', 20);
			$table->integer('SAP_DocEntry');
			$table->boolean('Subcontracted_Services');
			$table->integer('LgrBew_ID');
			$table->integer('Prev_Ref_INV_ID')->default(0);
			$table->integer('ZusatzInt01');
			$table->integer('ZusatzInt02');
			$table->integer('ZusatzInt03');
			$table->float('ZusatzFloat01', 53, 0);
			$table->float('ZusatzFloat02', 53, 0);
			$table->float('ZusatzFloat03', 53, 0);
			$table->string('ZusatzVarchar01', 50);
			$table->string('ZusatzVarchar02', 50);
			$table->string('ZusatzVarchar03', 50);
			$table->dateTime('ZusatzDate01')->nullable();
			$table->dateTime('ZusatzDate02')->nullable();
			$table->dateTime('ZusatzDate03')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('azure')
            ->dropIfExists('Szamlak');
	}

    /**
     * CreateAlkalmazottakTable constructor.
     * @param $table
     */
    public function __construct()
    {
        $config = config('appConfig.tables')['szamlak'];
        $this->table = $config['name'];
        $this->connection = $config['connection'];
    }
}
