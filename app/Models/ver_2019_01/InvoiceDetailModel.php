<?php

namespace App\Models\ver_2019_01;

//use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property int $ClientID
 * @property int $TransactID
 * @property int $Inv_ID
 * @property int $SeqNum
 * @property int $Comp_Inv_ID
 * @property int $Pos_ID
 * @property string $Ord_Num
 * @property string $PosInfo
 * @property int $Part_ID
 * @property int $Rates_ID
 * @property string $Descr
 * @property string $Note
 * @property float $Pcs
 * @property string $Unit
 * @property float $UnitPrice_DC
 * @property float $Net_DC
 * @property int $ACCT_TaxCodes_ID
 * @property float $TaxRate
 * @property float $Tax_DC
 * @property float $Gross_DC
 * @property float $UnitPrice_FC2
 * @property float $Net_FC2
 * @property float $Tax_FC2
 * @property float $Gross_FC2
 * @property int $Curr_ID
 * @property float $Rate_DC
 * @property int $Rate_Unit_DC
 * @property string $Rate_Date_DC
 * @property float $Rate_FC
 * @property int $Rate_Unit_FC
 * @property float $UnitPrice_FC
 * @property float $Net_FC
 * @property float $Tax_FC
 * @property float $EURBrutto
 * @property string $Rate_Date_FC
 * @property int $Ord_Calc_ID
 * @property float $Rate_LC
 * @property int $Rate_Unit_LC
 * @property string $Rate_Date_LC
 * @property float $UnitPrice_LC
 * @property float $Net_LC
 * @property float $Tax_LC
 * @property float $Gross_LC
 * @property string $Period_FROM
 * @property string $Period_TO
 * @property boolean $Subcontracted_Services
 * @property int $ConseqNum
 * @property int $INV_Group_ConseqNum
 * @property int $UserFld_int01
 * @property int $UserFld_int02
 * @property int $UserFld_int03
 * @property float $UserFld_float01
 * @property float $UserFld_float02
 * @property float $UserFld_float03
 * @property string $UserFld_nvarchar01
 * @property string $UserFld_nvarchar02
 * @property string $UserFld_nvarchar03
 * @property string $UserFld_date01
 * @property string $UserFld_date02
 * @property string $UserFld_date03
 */
class InvoiceDetailModel extends \Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Inv_L';
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'azure';

    /**
     * @var array
     */
    protected $fillable = [
        'ID', 'ClientID', 'TransactID', 'Inv_ID', 'SeqNum',
        'Comp_Inv_ID', 'Pos_ID', 'Ord_Num', 'PosInfo', 'Part_ID',
        'Rates_ID', 'Descr', 'Note', 'Pcs', 'Unit',
        'UnitPrice_DC', 'Net_DC', 'ACCT_TaxCodes_ID', 'TaxRate', 'Tax_DC',
        'Gross_DC', 'UnitPrice_FC2', 'Net_FC2', 'Tax_FC2', 'Gross_FC2',
        'Curr_ID', 'Rate_DC', 'Rate_Unit_DC', 'Rate_Date_DC', 'Rate_FC',
        'Rate_Unit_FC', 'UnitPrice_FC', 'Net_FC', 'Tax_FC', 'EURGros',
        'Rate_Date_FC', 'Ord_Calc_ID', 'Rate_LC', 'Rate_Unit_LC', 'Rate_Date_LC',
        'UnitPrice_LC', 'Net_LC', 'Tax_LC', 'Gross_LC', 'Period_FROM',
        'Period_TO', 'Subcontracted_Services', 'ConseqNum', 'INV_Group_ConseqNum',
        'UserFld_int01', 'UserFld_int02', 'UserFld_int03', 'UserFld_float01',
        'UserFld_float02', 'UserFld_float03', 'UserFld_nvarchar01', 'UserFld_nvarchar02',
        'UserFld_nvarchar03', 'UserFld_date01', 'UserFld_date02', 'UserFld_date03'];

    /**
     * InvoiceDetailModel constructor.
     * @param int $ID
     */
    public function __construct()
    {
        $config = config('appConfig.tables.invoice_details.' . session()->get('version'));
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

}
