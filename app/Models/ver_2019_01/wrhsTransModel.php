<?php

namespace App\Models\ver_2019_01;

use App\Models\UserQueryModel;
use Illuminate\Database\Eloquent\Model;

class wrhsTransModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'CP_WRHS_TRANS';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID',                           'ClientID',                 'SELEXPED_WRHS_TRANS_ID',
        'TransactID',                   'Cust_ID',                  'Movement_No',
        'Movement_Type',                'Booking_Date',             'DeliveryDate',
        'Deadline',                     'Customs_Clearance_Date',   'DeliveryNote_No',
        'Cont_Num',                     'Plate_No',                 'Status',
        'Response_User_Name',           'Response_User_Email',      'Response_User_Phone',
        'Remarks_1',                    'Remarks_2',                'External_Movement_No',
        'External_Transport_Order_No',  'External_PO_No',           'External_DeliveryNote_No'];

    /**
     * wrhs_stock constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.wrhs_trans');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    public static function getAll(string $table_name = ''){
        $total = 0;
        $offset = 0;
        $limit = 10;
        $where = '';
        $sort = '';
        $group_by = '';
        // Lekérdezendő oszlopok
        $select = '';

        //$where = "Booking_Date >= ''" . request()->get('startDate') . "''";

        $loggedUser = \Auth::user();
        $cust_id = (int)$loggedUser->Supervisor_ID;
        $client_id = (int)$loggedUser->CompanyID;

        $start_date = request()->get('startDate');
        $end_date = request()->get('endDate');
        $date_cell = request()->get('dateCell');

        //$cust_id = 37127568;
        //$client_id = 1038482;
        // Lekérem a modelltől a tábla nevét
        $table_name = (new wrhsTransModel())->getTable();

        // Riport neve
        $query_name = (request()->has('query_name')) ? request()->get('query_name') : config('appConfig.default_query_name');
        // Riport leírása
        $query_description = (request()->has('query_description')) ? request()->get('query_description') : '';

        //dd('wrhsStockModel::all', request()->all(), $table_name, $query_name, session()->has("{$table_name}.{$query_name}"));

        // Session-ből kiveszem at oszlop listát
        //$json_table_columns = session()->get($table_name);
        $json_table_columns = session()->get("{$table_name}.{$query_name}");
//dd('wrhsStockModel::getAll', $table_name, $query_name, $json_table_columns);
        // Oszlop lista tömbbé alakítása
        $arr_table_columns = json_decode($json_table_columns, true);
//dd('wrhsStockModel::getAll', $arr_table_columns);
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
            if(Auth::user()->hasRole('Admin')) {
                $res = UserQueryModel::sync([
                    'client_id' => $client_id,
                    'cust_id' => $cust_id,
                    'table_name' => $table_name,
                    'query_name' => $query_name,
                    'query_description' => $query_description,
                    'columns' => $json_table_columns,
                ]);
            }
            session()->put("{$table_name}.{$query_name}", $json_table_columns);
        }

        // Oldaltörés paraméterei
        if( request()->has('limit') )
        {
            $limit = (int)request()->get('limit');
        }
        if( request()->has('offset') )
        {
            $offset = (int)request()->get('offset');
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

        $model = new wrhsTransModel();
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

        $config = config('appConfig.tables.wrhs_trans');
        $query = "EXECUTE [dbo].[{$config['read']}]
            {$client_id},{$cust_id},'{$start_date}','{$end_date}','{$date_cell}','{$select}','{$where}','{$group_by}','{$sort}',{$offset},{$limit};";

        //dd('wrhsTransModel::getAll', $where, request()->all(), $query);

        $rows = \DB::connection($config['connection'])
            ->select(\DB::raw($query));

        $stocks = [
            'query' => $query,
            'total' => $total,
            'totalNotFiltered' => count($rows),
            'rows' => $rows,
        ];
        //dd('wrhsStockModel::all ajax', $stocks);
        return $stocks;

    }

    public static function all($columns = ['*'])
    {
        $config = config('appConfig.tables.wrhs_trans');
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

        $model = new wrhsTransModel();
        $model = $model->where('ClientID', '=', $CompanyID);
        $res = $model->get();
        $total = $model->count();

        $model = $model->orderBy('ID', 'asc')
            ->take($limit)
            ->skip($offset);

        $res = $model->get();

        $stocks = [
            //'sql' => $model->toSql(),
            'total'             => $total,
            'totalNotFiltered'  => count($res),
            'rows'              => $res,
        ];

        return json_encode($stocks);
    }

    public function trans_l()
    {
        return $this->hasMany(
            '\App\Models\wrhs_trans_l',
            'SELEXPED_WRHS_TRANS_ID',
            'SELEXPED_WRHS_TRANS_ID');
    }

    public function getTable(){

        return strtolower(( config('appConfig.tables.wrhs_trans') )['table']);
    }

}
