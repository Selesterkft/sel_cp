<?php

/*
 * Generating command:
 * php artisan migrate:generate Alkalmazottak --connection="azure"
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlkalmazottakTable extends Migration
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
			$table->integer('ID')->default(0)->primary('PK_Alkalmazottak');
			$table->integer('TransactID')->nullable();
			$table->integer('BeosztasID')->nullable()->default(0)->index('BeosztasID');
			$table->string('BeosztasPontosMegn', 50)->nullable();
			$table->string('Nev', 50)->nullable()->index('Nev');
			$table->string('Lakcim_Orszag', 3)->nullable();
			$table->string('Lakcim_State', 10)->nullable();
			$table->string('Lakcim_ISZ', 12)->nullable();
			$table->string('Lakcim_Hsg', 50)->nullable();
			$table->string('Lakcim_Utca', 100)->nullable();
			$table->string('Levcim_Orszag', 3)->nullable();
			$table->string('Levcim_State', 10)->nullable();
			$table->string('Levcim_ISZ', 12)->nullable();
			$table->string('Levcim_Hsg', 50)->nullable();
			$table->string('Levcim_Utca', 100)->nullable();
			$table->string('Telefon1', 24)->nullable();
			$table->string('Telefon2', 24)->nullable();
			$table->string('Fax', 24)->nullable();
			$table->string('Email', 50)->nullable();
			$table->string('TelOtthon1', 24)->nullable();
			$table->string('TelOtthon2', 24)->nullable();
			$table->string('Adoazonosito', 20)->nullable();
			$table->string('TAJszam', 20)->nullable();
			$table->string('TBszam', 20)->nullable();
			$table->string('AnyjaNeve', 50)->nullable();
			$table->string('LeanykoriNeve', 50)->nullable();
			$table->dateTime('SzulDatum')->nullable();
			$table->string('SzulHely', 30)->nullable();
			$table->float('NettoFiz', 53, 0)->nullable()->default(0);
			$table->float('BruttoFiz', 53, 0)->nullable()->default(0);
			$table->float('TBjarulek', 53, 0)->nullable()->default(0);
			$table->float('Potlek01', 53, 0)->nullable();
			$table->float('Potlek02', 53, 0)->nullable();
			$table->float('Potlek03', 53, 0)->nullable();
			$table->float('Potlek04', 53, 0)->nullable();
			$table->float('Potlek05', 53, 0)->nullable();
			$table->float('Potlek06', 53, 0)->nullable();
			$table->float('Potlek07', 53, 0)->nullable();
			$table->float('Potlek08', 53, 0)->nullable();
			$table->float('Potlek09', 53, 0)->nullable();
			$table->float('Potlek10', 53, 0)->nullable();
			$table->string('Nyugdijpenztar', 50)->nullable();
			$table->string('NyugdijpenztarPenzforg', 10)->nullable();
			$table->string('NyugdijpenztarBankszla', 20)->nullable();
			$table->string('NameInFremdsprache1', 50)->nullable();
			$table->string('NameInFremdsprache2', 50)->nullable();
			$table->string('VezetoiVizsgaKategoria', 50)->nullable();
			$table->string('VezetoiKartyaSzama', 50)->nullable();
			$table->dateTime('VezetoiVizsgaErv')->nullable();
			$table->dateTime('TIRVizsgaErv')->nullable();
			$table->dateTime('UtlevelErv')->nullable();
			$table->dateTime('ADRVizsgaErv')->nullable();
			$table->string('UtlevelSzama', 50)->nullable();
			$table->string('ADRVizsgaSzama', 50)->nullable();
			$table->string('SzemelyiIgazolvany', 12)->nullable();
			$table->boolean('KilepettIN')->default(0);
			$table->dateTime('KilepDatum')->nullable();
			$table->dateTime('BelepDatum')->nullable();
			$table->dateTime('MunkavallaloiEngErvenyes')->nullable();
			$table->dateTime('EgyebOkmanyErvenyes')->nullable();
			$table->dateTime('NemzArufuvKartyaErvenyes')->nullable();
			$table->string('NemzArufuvKartyaSzama', 50)->nullable();
			$table->dateTime('GKIKartyaErvenyes')->nullable();
			$table->string('GKIKartyaSzama', 50)->nullable();
			$table->dateTime('GepjarmuvezetoiKartyaErvenyes')->nullable();
			$table->string('GepjarmuvezetoiKartyaSzama', 50)->nullable();
			$table->integer('Cegek_ID')->nullable()->default(0);
			$table->string('CegekNev1', 100)->nullable();
			$table->boolean('NotInUse')->default(0);
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
        $config = config('appConfig.tables')['alkalmazottak'];
        $this->table = $config['name'];
        $this->connection = $config['connection'];
    }
}
