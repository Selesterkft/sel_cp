<?php

namespace App\Models\ver_2019_01;

use Illuminate\Database\Eloquent\Model;

class wrhsStockModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'CP_WRHS_STOCKS';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID',                   'ClientID',         'Cust_ID',
        'Stock_Date',           'Items_No',         'Items_Description_1',
        'Items_Description_2',  'Expire_Date',      'Prod_Date',
        'LOT_1',                'LOT_2',            'Warehouse',
        'Location',             'Status',           'Price_UnitPrice',
        'Price_Currency',       'Price_Unit',       'Weight_Net',
        'Weight_Gross',         'Stock_Available',  'Stock_Reserved',
        'Stock_External_1',     'Stock_External_2', 'Stock_External_3'];

    /**
     * wrhs_stock constructor.
     * @param string $connection
     */
    public function __construct()
    {
        $config = config('appConfig.tables.wrhs_stocks');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    public static function all($columns = ['*'])
    {
        $config = config('appConfig.tables.wrhs_stocks');
        $loggedUser = \Auth::user();
        $CompanyID = $loggedUser->CompanyID;

        if( request()->has('limit') )
        {
            $limit = request()->get('limit');
        }
        if( request()->has('offset') )
        {
            $offset = request()->get('offset');
        }

        $model = new wrhsStockModel();
        $model = $model->where('ClientID', '=', $CompanyID);
        $res = $model->get();
        $total = $model->count();

        $model = $model->orderBy('ID', 'asc')
            ->take($limit)
            ->skip($offset);

        $res = $model->get();

        $wrhs_stocks = [
            'total'             => $total,
            'totalNotFiltered'  => count($res),
            'rows'              => $res,
        ];

        return json_encode($wrhs_stocks);
    }
}
