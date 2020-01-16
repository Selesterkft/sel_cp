<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Spatie\Activitylog\Traits\LogsActivity;

class CurrModel extends Model
{
    use SoftDeletes;
    //use LogsActivity;

    protected $connection = 'azure';
    protected $table = 'CP_Currs';
    protected $primaryKey = 'ID';
    protected $fillable = ['Curr_ID', 'Curr_DC'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    /**
     * CurrModel constructor.
     * @param string $connection
     */
    public function __construct()
    {
        $config = config('appConfig.tables.currencies');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }
}
