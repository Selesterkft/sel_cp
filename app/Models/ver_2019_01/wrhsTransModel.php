<?php

namespace App\Models\ver_2019_01;

use Illuminate\Database\Eloquent\Model;

class wrhs_transModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'wrhs_trans';
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
     * @param string $connection
     */
    public function __construct()
    {
        $config = config('appConfig.tables.wrhs_trans');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    public static function all($columns = ['*'])
    {
        $config = config('appConfig.tables.wrhs_trans');
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

        $model = new wrhs_transModel();
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

}
