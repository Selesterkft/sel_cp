<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrsTable extends Migration
{
    protected $connection,
                $table;
    /**
     * CreateCurrsTable constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.currencies');
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
            ->create($this->table, function (Blueprint $table)
        {
            $table->increments('ID')->comment('Rekord azonosító');
            $table->integer('Curr_ID')->unique()->comment('Pénznem azonosítója');
            $table->string('Curr_DC', 3)->unique()->comment('Pénznem kódja');
            $table->string('Curr_Format', 255)->comment('Pénznem formázás');

            $table->timestamps();
            $table->softDeletes();
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
