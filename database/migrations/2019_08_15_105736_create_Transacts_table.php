<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactsTable extends Migration
{
    protected $connection, $table;
    /**
     * CreateTransactsTable constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.transacts');
        $this->connection = $config['connection'];
        $this->table = $config['name'];
    }


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
			$table->integer('TransactID', true);
			$table->dateTime('TransactDate')->index('IX_Transacts_TransactDate');
			$table->string('Terminal', 10);
			$table->string('TableName', 128)->default('');
			$table->string('FieldName', 128)->default('');
			$table->integer('ForUser')->default(0);
			$table->integer('UserID');
			$table->string('ProcedureName', 128);
			$table->integer('RecordID');
			$table->integer('ParentTransactID');
			$table->boolean('NoTriggers')->default(0);
			$table->string('SavePoint', 32);
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
            ->drop($this->table);
	}

}
