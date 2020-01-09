<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    protected $connection, $table;

    /**
     * CreateConfigTable constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.settings');
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
        Schema::connection($this->connection)->create($this->table, function (Blueprint $table)
        {
            $table->increments('ID');
            $table->integer('CompanyID')->index();
            $table->string('PropertyName', 255)->index();
            $table->string('PropertyValue', 255)->index();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['CompanyID', 'PropertyName']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->dropIfExists($this->table);
    }
}
