<?php

/*
 * Generating command:
 * php artisan migrate:generate Szamlatetelek --connection="azure"
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSzamlatetelekTable extends Migration
{
    private $connection, $_table;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection($this->connection)
            ->create($this->_table, function(Blueprint $table)
		{
			$table->integer('ID')->default(0)->primary('PK_Szamlatetelek');
			$table->integer('TransactID')->default(0);
			$table->integer('SzamlaID')->default(0)->index('SzamlaID');
			$table->integer('Alsorszam')->default(0)->index('IX_Szamlatetelek_Alsorszam');
			$table->integer('Ref_Komp_Szamlak_ID')->default(0);
			$table->integer('RefFrom_Szamlak_ID')->default(0);
			$table->integer('RefFrom_Szamlatetelek_ID')->default(0)->index('IX_Szamlatetelek_RefFrom_Szamlatetelek_ID');
			$table->integer('RefTo_Szamlatetelek_ID')->default(0)->index('IX_Szamlatetelek_RefTo_Szamlatetelek_ID');
			$table->integer('PosTipusID')->default(0);
			$table->integer('PosID')->index('PosID');
			$table->string('PozSzam', 25)->index('IX_Szamlatetelek_PozSzam');
			$table->string('PosInfo', 128);
			$table->integer('ResztvevoID');
			$table->integer('ResztvevoCode')->default(0);
			$table->integer('TarifID')->default(0);
			$table->string('Megnevezes');
			$table->string('TarifBemerkung')->nullable();
			$table->float('Darab', 53, 0)->default(0);
			$table->string('ME', 4);
			$table->float('Egysegar', 53, 0);
			$table->float('Net', 53, 0);
			$table->integer('SteuerCode')->default(0);
			$table->float('AFAkulcs', 53, 0)->default(0);
			$table->float('AFA', 53, 0);
			$table->float('Gros', 53, 0);
			$table->float('FWStkPreis', 53, 0)->default(0);
			$table->float('FWNet', 53, 0)->default(0);
			$table->float('FWMwSt', 53, 0);
			$table->float('FWGros', 53, 0);
			$table->integer('Wahrung')->default(0);
			$table->float('Kurs', 53, 0);
			$table->integer('KursEinheit')->default(0);
			$table->dateTime('KursDatum')->index('IX_Szamlatetelek_KursDatum');
			$table->float('EURKurs', 53, 0);
			$table->integer('EURKursEinheit')->default(0);
			$table->float('EURStkPreis', 53, 0)->default(0);
			$table->float('EURNet', 53, 0);
			$table->float('EURMwSt', 53, 0);
			$table->float('EURGros', 53, 0);
			$table->dateTime('EURKursDatum')->index('IX_Szamlatetelek_EURKursDatum');
			$table->integer('OrigLeistID')->index('OrigLeistID');
			$table->float('FIBUKurs', 53, 0);
			$table->integer('FIBUKursEinheit')->default(0);
			$table->dateTime('FIBUKursDatum')->index('IX_Szamlatetelek_FIBUKursDatum');
			$table->float('FIBUStkPreis', 53, 0)->default(0);
			$table->float('FIBUNet', 53, 0)->default(0);
			$table->float('FIBUMwSt', 53, 0)->default(0);
			$table->float('FIBUGros', 53, 0)->default(0);
			$table->boolean('Calculated')->default(0);
			$table->integer('SAP_DocEntry')->nullable();
			$table->integer('SAP_LineNum')->nullable();
			$table->dateTime('Period_FROM')->nullable();
			$table->dateTime('Period_TO')->nullable();
			$table->boolean('Subcontracted_Services')->index('IX_Szamlatetelek_Subcontracted_Services');
			$table->integer('ConseqNum')->default(0);
			$table->integer('INV_Group_ConseqNum')->default(0);
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
		Schema::connection($this->connection)
            ->dropIfExists($this->_table);
	}

    /**
     * CreateAlkalmazottakTable constructor.
     * @param $table
     */
    public function __construct()
    {
        $config = config('appConfig.tables')['szamlatetelek'];
        $this->table = $config['name'];
        $this->connection = $config['connection'];
    }
}
