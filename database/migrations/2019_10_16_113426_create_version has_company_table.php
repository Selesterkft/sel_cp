<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionHasCompanyTable extends Migration
{
    protected $connection, $table;

    /**
     * CreateVersionHasCompanyTable constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.version_has_company');
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

            $table->integer('CompanyID')->index();
            $table->integer('VersionID')->index();
            $table->integer('Active')->default(1)->index();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['CompanyID', 'VersionID']);
            $table->index(['CompanyID', 'Active']);
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
