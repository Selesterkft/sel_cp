<?php

namespace App\Models\ver_2019_01;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class StockModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'CP_Stocks';
    protected $primaryKey = 'ID';
    protected $fillable = ['CompanyID', 'ProductName', 'Quantity', 'Unit', 'UnitPrice', 'Value'];
    //

    /**
     * StockModel constructor.
     * @param string $connection
     */
    public function __construct()
    {
        parent::__construct();

        $config = config('appConfig.tables.stocks.' . session()->get('version'));
        $this->connection = $config['connection'];
        $this->table = $config['read'];
    }

    public static function all($columns = ['*'])
    {
        $config = config('appConfig.tables.stocks.' . session()->get('version'));
        $loggedUser = Auth::user();
        $CompanyID = $loggedUser->CompanyID;

        if( request()->has('limit') )
        {
            $limit = request()->get('limit');
        }
        if( request()->has('offset') )
        {
            $offset = request()->get('offset');
        }

        $model = new StockModel();
        $model = $model->where('CompanyID', '=', $CompanyID);
        $res = $model->get();
        $total = $model->count();

        $model = $model->orderBy('ID', 'asc')
            ->take($limit)
            ->skip($offset);

        $res = $model->get();

        $stocks = [
            //'sql' => $model->toSql(),
            'total' => $total,
            'totalNotFiltered' => count($res),
            'rows' => $res,
        ];
        //dd('StockModel::all', $stocks);
        return json_encode($stocks);
    }
}
