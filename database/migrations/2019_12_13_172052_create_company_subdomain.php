<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySubdomain extends Migration
{    
    protected $connection, $table;
    
    function __construct() 
    {
        $config = config('appConfig.tables.company_has_subdomain');
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
            $table->increments('id');
            $table->integer('CompanyID')->index();
            $table->string('CompanyName', 255)->index();
            $table->string('CompanyNickName', 255)->index();
            $table->string('SubdomainName', 255)->index();
            
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
        Schema::connection($this->connection)->dropIfExists($this->table);
    }
}
