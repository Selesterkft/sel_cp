<?php

/*
 * Generating command:
 * php artisan migrate:generate menus --connection="mysql"
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenu extends Migration
{
    protected $connection, $_table;

    /**
     * CreateAlkalmazottakTable constructor.
     * @param $table
     */
    public function __construct()
    {
        $config = config('appConfig.tables.menus');
        $this->table = $config['name'];
        $this->connection = $config['connection'];
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
            $table->increments('id');
            $table->integer('parent')->nullable();
            $table->string('name', 255);
            $table->string('icon', 255);
            $table->string('slug', 255);
            $table->integer('number');

            $table->uuid('guid');
            $table->uuid('checksum');
            $table->timestamps();
            $table->softDeletes();

            $table->index('parent');
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
