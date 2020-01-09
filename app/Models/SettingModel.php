<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class SettingModel extends \Eloquent
{
    protected $connection = 'azure';
    protected $table = 'settings';
    protected $primaryKey = 'ID';
    protected $fillable = ['PropertyName', 'PropertyValue'];
            
    function __construct() 
    {
        $config = config('appConfig.tables.settings');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }
}
