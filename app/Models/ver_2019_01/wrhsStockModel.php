<?php

namespace App\Models\ver_2019_01;

use App\Models\TableColumnModel;
use DB;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class wrhsStockModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'CP_WRHS_STOCKS';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID', 'ClientID', 'Cust_ID', 'Stock_Date', 'Items_No',
        'Items_Description_1', 'Items_Description_2', 'Expire_Date', 'Prod_Date', 'LOT_1',
        'LOT_2', 'Warehouse', 'Location', 'Status', 'Price_UnitPrice',
        'Price_Currency', 'Price_Unit', 'Weight_Net', 'Weight_Gross', 'Stock_Available',
        'Stock_Reserved', 'Stock_External_1', 'Stock_External_2', 'Stock_External_3'
    ];

    /**
     * wrhs_stock constructor.
     * @param string $connection
     */
    public function __construct()
    {
        parent::__construct();
        $config = config('appConfig.tables.wrhs_stocks');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    public static function all($columns = ['*'])
    {
        //$visibleColumns = request()->get('visibleColumns');
        //$hiddenColumns = request()->get('hiddenColumns');

        // Ha az oldaltól jön oszlop adat, az azt jelenti,
        // hogy változtattak a táblázat összeállításán.
        // Frissíteni kell az adatbázisban és a Session-ben a mező listákat.
        $table_columns = [];
        if( request()->has('visibleColumns') )
        {
            //
        }

        $total = 0;
        $limit = 0;
        $offset = 0;
        $where = '';
        $sort = '';

        //$loggedUser = \Auth::user();
        //$customer_id = (int)$loggedUser->Supervisor_ID;
        //$client_id = (int)$loggedUser->CompanyID;

        $customer_id = 37127568;
        $client_id = 1038482;

        $table_name = (new wrhsStockModel())->getTable();

        $model = new wrhsStockModel();
        $model = $model
            ->where('ClientID', $client_id)
            ->where('Cust_ID', $customer_id)
            ->get();
        $total = $model->count();

        // Oldaltörés paraméterei
        if( request()->has('limit') )
        {
            $limit = request()->get('limit');
        }
        if( request()->has('offset') )
        {
            $offset = request()->get('offset');
        }

        // Rendezés paraméterei
        if( request()->has('sort') )
        {
            $sort = request()->get('sort');
            $order = 'asc';
            if( request()->has('order') )
            {
                $order = request()->get('order');
            }
            $sort .= " {$order}";
        }

        $query = "EXECUTE [dbo].[CP_STOCK_GET_01] {$client_id}, {$customer_id}, '{$table_name}', {$offset}, {$limit}, '{$where}', '{$sort}';";

        dd('wrhsStockModel::all ajax', $query);

        $rows = [];

        $stocks = [
            'table_columns' => $table_columns,
            'total' => $total,
            'totalNotFiltered' => count($rows),
            'rows' => $rows,
        ];

        return $stocks;
    }

    public static function all_01($columns = ['*'])
    {
        $visibleColumns = request()->get('visibleColumns');
        $hiddenColumns = request()->get('hiddenColumns');

        //$total = 0;
        $limit = 0;
        $offset = 0;
        //$where = '';
        $sort = '';

        //$config = config('appConfig.tables.stocks.' . session()->get('version'));

        //$loggedUser = \Auth::user();
        //$customer_id = (int)$loggedUser->Supervisor_ID;
        //$client_id = (int)$loggedUser->CompanyID;

        $customer_id = 37127568;
        $client_id = 1038482;

        $table_name = (new wrhsStockModel())->getTable();

        if( !empty(request()->get('sort')) )
        {
            $sort = request()->get('sort');
            $order = 'asc';
            if( !empty(request()->get('order')) )
            {
                $order = request()->get('order');
            }
            $sort .= " {$order}";
        }

        if( request()->has('limit') )
        {
            $limit = request()->get('limit');
        }
        if( request()->has('offset') )
        {
            $offset = request()->get('offset');
        }

        //dd('wrhsStockModel::all', $client_id, $supervisor_id, $table_name, $visibleColumns, $hiddenColumns);

        /*
         * Szinkronizálja az oldalról jövő cella listát és a mentett listát,
         * majd visszaadjuk az érvényes listát.
         * Első alkalommal a model $fillable változóját használom.
         * */
        $cols = self::sync(
            $client_id, $customer_id,
            $table_name, $visibleColumns, $hiddenColumns);

        /** @var array $table_columns */
        $table_columns['Fields'] = json_decode($cols['VisibleColumns']);

        $table_columns['HiddenFields'] = json_decode($cols['HiddenColumns']);

        $json_columns = json_encode($table_columns);
        //dd('wrhsStockModel::all', $json_columns, $table_columns);
        $model = new wrhsStockModel();
        $model = $model
            ->where('ClientID', $client_id)
            ->where('Cust_ID', $customer_id)
            ->get();

        $total = $model->count();

        $query = "EXECUTE [dbo].[CP_STOCK_GET_Kovi_verzio] "
            . $client_id . ", " . $customer_id . ", "
            . $offset . ", " . $limit . ", '"
            . $sort . "', '" . $json_columns . "'";

        $rows = DB::connection('azure')->select(DB::raw($query));

        $stocks = [
            //'cols' => $cols,
            'table_columns' => $table_columns,
            'total' => $total,
            'totalNotFiltered' => count($rows),
            'rows' => $rows,
        ];
//dd('wrhsStockModel::all', $stocks['table_columns']);
        return $stocks;
    }

    public static function sync(
        int $client_id, int $supervisor_id,
        string $table_name, ?string $visibleColumns, ?string $hiddenColumns) : array
    {
        try {
            $res_array = TableColumnModel::getTableColumns(
                $client_id = $client_id,
                $cust_id = $supervisor_id,
                $table_name = $table_name,
                'wrhsStockModel');
        } catch (BindingResolutionException $e) {
        }

        //dd('wrhsStockModel::all', $res_array);

        return $res_array;
    }

    /**
     * @return mixed|string
     */
    public function getTable()
    {
        return ( config('appConfig.tables.wrhs_stocks') )['table'];
    }
}
