<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'CP_Designs';

    /**
     * DesignModel constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.designs');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
        //dd('DesignsModel::construct', $config);
    }
}
