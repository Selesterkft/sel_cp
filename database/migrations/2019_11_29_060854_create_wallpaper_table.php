<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWallpaperTable extends Migration
{
    private $config = [];
    
    public function __construct() {
        $this->config = config('appConfig.tables.wallpapers');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->config['connection'])->create($this->config['table'], function (Blueprint $table) {
            
            $table->increments('ID');
            $table->string('Name', 255)->index('IX_wallpapers_name');
            
            
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
        Schema::connection($this->config['connection'])->dropIfExists($this->config['table']);
    }
}
