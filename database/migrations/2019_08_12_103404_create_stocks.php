<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocks extends Migration
{
    protected $connection, $table;

    /**
     * CreateStocks constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.stocks');
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
                $table->integer('company_id');
                $table->integer('product_id');
                $table->integer('quantity');
                $table->integer('unit');

                $table->uuid('guid');
                $table->uuid('checksum');
                $table->timestamps();
                $table->softDeletes();

                $table->index(['company_id', 'product_id'], 'IX_stock_company_product');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }


}
