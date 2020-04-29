<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableColumns extends Migration
{
    protected $connection = '';
    protected $table = '';

    /**
     * CreateTableColumns constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)
            ->create($this->table, function (Blueprint $table) {

            $table->increments('ID');

            $table->integer('ClientID');
            $table->integer('Cust_ID');

            //$table->integer('UsersID')->index();
            $table->string('TableName', 255)->index();
            $table->text('VisibleColumns');
            $table->text('HiddenColumns');

            $table->timestamps();

            $table->index(['UsersID', 'TableName']);
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
}
