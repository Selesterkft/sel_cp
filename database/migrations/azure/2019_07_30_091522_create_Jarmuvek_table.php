<?php

/*
 * Generating command:
 * php artisan migrate:generate Jarmuvek --connection="azure"
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJarmuvekTable extends Migration
{
    private $connection, $_table;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection($this->connection)->create($this->_table, function(Blueprint $table)
		{
			$table->integer('ID')->default(0)->primary('PK_Jarmuvek');
			$table->integer('TransactID');
			$table->integer('JarmuCsoportID')->default(0)->index('JarmuCsoportID');
			$table->boolean('TGK_PKCS')->default(0);
			$table->integer('PKCS_ID')->default(0)->index('PKCS_ID');
			$table->string('Rendszam', 10)->index('Rendszam');
			$table->string('BelsoAzonosito', 10);
			$table->string('ILU_Code', 12)->default('');
			$table->string('Tipus', 50);
			$table->string('Felepitmeny', 50);
			$table->integer('Alkalmazottak_ID')->default(0)->index('Alkalmazottak_ID');
			$table->dateTime('GyartasiDatum')->nullable();
			$table->dateTime('BeszerzesDatuma')->nullable();
			$table->dateTime('EladasiDatum')->nullable();
			$table->float('MegengedettOsszSuly', 53, 0)->default(0);
			$table->float('Rakterfogat', 53, 0)->default(0);
			$table->float('MaxLM', 53, 0);
			$table->float('Belmagassag', 53, 0);
			$table->float('Szelesseg', 53, 0);
			$table->float('Hosszusag', 53, 0);
			$table->float('KoltsegPerKM', 53, 0)->default(0);
			$table->float('KoltsegPerNap', 53, 0)->default(0);
			$table->dateTime('NemzetkoziBiztErvenyes')->nullable();
			$table->dateTime('TachografNextDownload')->nullable();
			$table->dateTime('TachografErvenyes')->nullable();
			$table->string('TachografSzama', 50);
			$table->dateTime('ZoldkartyaErvenyes')->nullable();
			$table->dateTime('VizsgaErvenyes')->nullable();
			$table->string('ForgalmiSzama', 50);
			$table->dateTime('ADRervenyes')->nullable();
			$table->string('ADReng', 30);
			$table->float('KotelezoBiztDija', 53, 0)->default(0);
			$table->float('GkgAdo', 53, 0)->default(0);
			$table->dateTime('LarmErvenyes')->nullable();
			$table->string('LarmSzama', 30);
			$table->dateTime('CertifikatErvenyes')->nullable();
			$table->string('CertifikatSzama', 50);
			$table->dateTime('CEMTErvenyes')->nullable();
			$table->string('CEMTSzama', 50);
			$table->string('CEMTZoldSzama', 50);
			$table->string('CEMTFeherSzama', 50);
			$table->dateTime('KozossegiEngErvenyes')->nullable();
			$table->string('KozossegiEngSzama', 50);
			$table->dateTime('KozutiFuvEngErvenyes')->nullable();
			$table->string('KozutiFuvEngSzama', 50);
			$table->dateTime('KotelezoBiztErvenyes')->nullable();
			$table->string('KotelezoBiztSzama', 50);
			$table->integer('KoltseghelyID')->default(0);
			$table->string('Alvazszam', 20);
			$table->string('Motorszam', 20);
			$table->string('KornyezetvedelmiKategoria', 20);
			$table->float('Onsuly', 53, 0)->default(0);
			$table->float('Terhelhetoseg', 53, 0)->default(0);
			$table->float('PKCSBelmagassag', 53, 0)->default(0);
			$table->float('PKCSSzelesseg', 53, 0)->default(0);
			$table->float('PKCSHosszusag', 53, 0)->default(0);
			$table->boolean('Eladva')->default(0);
			$table->float('UAnorma', 53, 0)->default(0);
			$table->integer('AlvID')->index('AlvID');
			$table->float('Norma', 53, 0);
			$table->float('Potlek1', 53, 0);
			$table->float('Potlek2', 53, 0);
			$table->float('Potlek3', 53, 0);
			$table->float('Potlek4', 53, 0);
			$table->float('Potlek5', 53, 0);
			$table->float('APEHNorma', 53, 0);
			$table->float('APEHPotlek1', 53, 0);
			$table->float('APEHPotlek2', 53, 0);
			$table->float('APEHPotlek3', 53, 0);
			$table->float('APEHPotlek4', 53, 0);
			$table->float('APEHPotlek5', 53, 0);
			$table->integer('OlajcsereKmAllas');
			$table->string('OlajcsereKmAllas_Remark');
			$table->integer('FekcsereKmAllas');
			$table->string('FekcsereKmAllas_Remark');
			$table->integer('GumicsereKmAllas');
			$table->string('GumicsereKmAllas_Remark');
			$table->integer('TruckType');
			$table->boolean('NotInUse')->default(0);
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
		Schema::connection($this->connection)->drop($this->_table);
	}

    /**
     * CreateAlkalmazottakTable constructor.
     * @param $table
     */
    public function __construct()
    {
        $config = config('appConfig.tables')['vehicles'];
        $this->table = $config['name'];
        $this->connection = $config['connection'];
    }
}
