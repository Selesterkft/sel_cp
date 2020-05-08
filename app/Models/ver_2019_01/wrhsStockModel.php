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
        $total = 0;
        $offset = 0;
        $limit = 10;
        $where = '';
        $sort = '';
        $group_by = '';
        // Lekérdezendő oszlopok
        $select = '';

        //$loggedUser = \Auth::user();
        //$cust_id = (int)$loggedUser->Supervisor_ID;
        //$client_id = (int)$loggedUser->CompanyID;

        $cust_id = 37127568;
        $client_id = 1038482;
        // Lekérem a modelltől a tábla nevét
        $table_name = (new wrhsStockModel())->getTable();

        // Session-ből kiveszem at oszlop listát
        $json_table_columns = session()->get($table_name);
        // Oszlop lista tömbbé alakítása
        $arr_table_columns = json_decode($json_table_columns, true);

        // Ha az oldal felől jön oszlop adat, akkor ...
        if( request()->has('visibleColumns') && request()->get('visibleColumns') != '' )
        {
            // Látható oszlop adatok kivétele
            $visibleColumns = json_decode(request()->get('visibleColumns'), true);
            // Nem látható oszlop adatok kivétele
            $hiddenColumns = json_decode(request()->get('hiddenColumns'), true);

            // Végig járom az oszlopok listáját, hogy a láthatóságot beállítsam.
            foreach( $arr_table_columns as $id => $arr_table_column )
            {
                // Látható mezők vizsgálata
                if( in_array($arr_table_column['field'], $visibleColumns))
                {
                    // Ha van a láthatóságra vonatkozó beállítás, ...
                    if( isset($arr_table_column['visible']) )
                    {
                        // Kiveszem a beállítások közül.
                        unset($arr_table_columns[$id]['visible']);
                    }
                }

                // Nem látható mezők vizsgálata
                if( in_array($arr_table_column['field'], $hiddenColumns))
                {
                    // Láthatóságra vonatkozó beállítás megadása
                    $arr_table_columns[$id]['visible'] = false;
                }
            }

            $json_table_columns = json_encode($arr_table_columns);

            // Új oszloplista mentése az adatbázisba és a session-be.
            $res = TableColumnModel::sync(
                $client_id = $client_id,
                $cust_id = $cust_id,
                $table_name = $table_name,
                $columns = $json_table_columns
            );

            session()->put($table_name, $json_table_columns);
        }

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

        $model = new wrhsStockModel();
        $model = $model
            ->where('ClientID', $client_id)
            ->where('Cust_ID', $cust_id)
            ->get();
        $total = $model->count();

        // A lekérdezés mezőinek és csoportosítandó mezők listájának összeállítása
        foreach($arr_table_columns as $id => $arr_table_column)
        {
            // Ha az oszlop látható, akkor...
            if( !isset($arr_table_column['visible']) )
            {
                // Beteszem a lekérdezendő mezők listájába
                $select .= $arr_table_column['sql_field'] . ',';

                if( $arr_table_column['group'] == true)
                {
                    $group_by .= $arr_table_column['field'] . ',';
                }

                if( strlen($sort) == 0 )
                {
                    $sort = "{$arr_table_column['sql_field']} asc";
                }
            }
        }
        $select = substr_replace($select,"",-1);
        $group_by = substr_replace($group_by,"",-1);

        $query = "EXECUTE [dbo].[CP_STOCK_GET_ML_1] 
            {$client_id},{$cust_id},'{$select}','{$where}','{$group_by}','{$sort}','{$offset}','{$limit}';";

        $config = config('appConfig.tables.wrhs_stocks');
        $rows = DB::connection($config['connection'])
            ->select(DB::raw($query));

        $stocks = [
            //'table_columns' => $table_columns,
            'total' => $total,
            'totalNotFiltered' => count($rows),
            'rows' => $rows,
        ];
        //dd('wrhsStockModel::all ajax', $stocks);
        return $stocks;

    }

    public static function all_01($columns = ['*'])
    {
        $total = 0;
        $limit = 0;
        $offset = 0;
        $where = '';
        $sort = '';
        $group_by = '';
        $select = '';

        //$loggedUser = \Auth::user();
        //$customer_id = (int)$loggedUser->Supervisor_ID;
        //$client_id = (int)$loggedUser->CompanyID;

        $customer_id = 37127568;
        $client_id = 1038482;
        // Lekérem a modelltől a tábla nevét
        $table_name = (new wrhsStockModel())->getTable();

        //$visibleColumns = request()->get('visibleColumns');
        //$hiddenColumns = request()->get('hiddenColumns');

        // Ha az oldaltól jön oszlop adat, az azt jelenti,
        // hogy változtattak a táblázat összeállításán.
        // Frissíteni kell az adatbázisban és a Session-ben a mező listákat.
        $table_columns = [];
        if( request()->has('Columns') )
        {
            $columns = TableColumnModel::sync($client_id = $client_id,
                $cust_id = $customer_id,
                $table_name = $table_name,
                $columns = request()->get('Columns'),
                $visible_columns = request()->get('VisibleColumns'),
                $hidden_columns = request()->has('HiddenColumns'));
        }
        else
        {
            $columns = TableColumnModel::getTableColumns(
                $client_id = $client_id,
                $cust_id = $customer_id,
                $table_name = $table_name);
        }

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

        // Jön új táblázat adat az oldal felől?
        if( request()->has('VisibleColumns'))
        {
            $_columns = json_decode($columns, true);

            foreach($_columns as $id => $_column )
            {
                //dd('TableColumnModel::getTableColumns', $_column['field']);
                if( in_array($_column['field'], request()->has('VisibleColumns')) )
                {
                    //dd('TableColumnModel::getTableColumns', 'TALÁLAT');
                    if( isset( $_columns[$id]['visible'] ) ){
                        unset($_columns[$id]['visible']);
                    }
                }

                if( in_array($_column['field'], request()->has('HiddenColumns')) )
                {
                    $_columns[$id]['visible'] = false;
                }
            }
        }

        $session_columns = session()->get($table_name);
        $columns = json_decode($session_columns['Columns']);
        $visibleColumns = json_decode($session_columns['VisibleColumns']);
        $hiddenColumns = json_decode($session_columns['HiddenColumns']);

        //dd('wrhsStockModel::all ajax', $columns, $visibleColumns, $hiddenColumns );

        foreach( $columns as $column )
        {
            //dd('wrhsStockModel::all ajax', $column->field);

            if( in_array($column->field, $hiddenColumns) )
            {
                $column->visible = false;
                //dd('wrhsStockModel::all ajax', $column);
            }

        }
        //dd('wrhsStockModel::all ajax', $columns);

        //$query = "EXECUTE [dbo].[CP_STOCK_GET_01] {$client_id}, {$customer_id}, '{$table_name}', {$offset}, {$limit}, '{$where}', '{$sort}';";
        $query = "
DECLARE @Client_ID int = {$client_id};
DECLARE @Cust_ID int = {$customer_id};
DECLARE @SELECT nvarchar(max) = '{$select}';
DECLARE @WHERE nvarchar(max) = '{$where}';
DECLARE @GROUP_BY nvarchar(max) = '{$group_by}';
DECLARE @ORDER_BY nvarchar(max) = '{$sort}';
DECLARE @OFFSET int = {$offset};
DECLARE @LIMIT int = {$limit};

EXECUTE [dbo].[CP_STOCK_GET_ML_1] 
   @Client_ID
  ,@Cust_ID
  ,@SELECT
  ,@WHERE
  ,@GROUP_BY
  ,@ORDER_BY
  ,@OFFSET
  ,@LIMIT";

        dd('wrhsStockModel::all', $columns, $visibleColumns, $hiddenColumns, $query);

        $config = config('appConfig.tables.wrhs_stocks');
        $rows = DB::connection($config['connection'])
            ->select(DB::raw($query));

        $stocks = [
            'table_columns' => $table_columns,
            'total' => $total,
            'totalNotFiltered' => count($rows),
            'rows' => $rows,
        ];
        dd('wrhsStockModel::all ajax', $stocks);
        return $stocks;
    }



    /*
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
    */

    /**
     * @return mixed|string
     */
    public function getTable()
    {
        return ( config('appConfig.tables.wrhs_stocks') )['table'];
    }


}
