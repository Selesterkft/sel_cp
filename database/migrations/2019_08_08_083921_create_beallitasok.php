<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeallitasok extends Migration
{
    protected $table, $connection;
    /**
     * CreateBeallitasok constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.beallitasok');
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
            ->create($this->table, function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id');
            $table->string('name', 255);
            $table->string('value', 255);

            $table->uuid('guid');
            $table->uuid('checksum');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id', 'IX_beallitasok_user_id');
            $table->index(['user_id', 'name'], 'IX_beallitasok_user_id_name');
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
