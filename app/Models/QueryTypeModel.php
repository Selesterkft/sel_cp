<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueryTypeModel extends Model
{
    protected   $connection = 'azure',
                $table = 'CP_QueryTipes',
                $fillable = ['Type', 'Columns'];

    public $timestamps = false;

    /**
     * QueryTypeModel constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.query_types');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }
}
