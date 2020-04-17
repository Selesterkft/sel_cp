<?php

namespace App\Models\ver_2019_01;

use Illuminate\Database\Eloquent\Model;

class wrhs_trans_l extends Model
{
    protected $connection = 'azure';
    protected $table = 'wrhs_trans_l';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID',                               'SELEXPED_WRHS_TRANS_L_ID',
        'SELEXPED_WRHS_TRANS_ID',
        'CP_WRHS_TRANS_ID',                 'Line_SeqNum','Items_No',
        'Items_Description_1',              'Items_Description_2',
        'Transport_ORD_OrderNum',
        'Qty',                              'Expire_Date',          'Prod_Date',
        'LOT_1',                            'LOT_2',                'Volume',
        'Footprint',                        'Weight_Net',           'Weight_Gross',
        'FROM_Warehouse',                   'FROM_Location',        'FROM_Status',
        'TO_Warehouse',                     'TO_Location',          'TO_Status',
        'Line_Price_UnitPrice',             'Line_Price_Currency',  'Line_Price_Unit',
        'Line_Price_Net',                   'Line_Price_VAT',       'Line_Price_Gross',
        'External_MarksAndNumbers_01',      'External_MarksAndNumbers_02',
        'External_MarksAndNumbers_03',
        'Barcode_Picking_Pallet',           'Barcode_Picking_Box',  'Barcode_Item',
        'Stock_Available_After_Movement',   'Stock_Reserved_After_Movement',
        'Stock_External_1_After_Movement',  'Stock_External_2_After_Movement',
        'Stock_External_3_After_Movement'];

    /**
     * wrhs_stock constructor.
     * @param string $connection
     */
    public function __construct()
    {
        $config = config('appConfig.tables.wrhs_trans_l');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }
}
