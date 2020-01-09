<?php

namespace App\Models\ver_2019_01;

//use Illuminate\Database\Eloquent\Model;

use App\Classes\Helper;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class CompanyModel extends \Eloquent implements Searchable
{
    protected $connection, $table;
    protected $primaryKey = 'ID';
    protected $fillable = [
        'TransactID', 'SzamlazasiCim', 'SzCimTipus', 'Nyitvatartas', 'RovidNev',
        'Nev1', 'Nev2', 'Cust_Old_Name', 'Country_ID', 'Orszag',
        'State', 'ISZ', 'District', 'Varos', 'Utca',
        'Addr_ps_type', 'Addr_housenr', 'Addr_building', 'Addr_stairway', 'Addr_floor',
        'Addr_door', 'Spec_Addr', 'SzNev1', 'SzNev2', 'Inv_Country_ID',
        'SzOrszag', 'SzState', 'SzISZ', 'Inv_Addr_District', 'SzVaros',
        'SzUtca', 'Inv_Addr_ps_type', 'Inv_Addr_housenr', 'Inv_Addr_building', 'Inv_Addr_stairway',
        'Inv_Addr_floor', 'Inv_Addr_door', 'Inv_Spec_Addr', 'Fopartner', 'RaktarFopartner',
        'Mail_Country_ID', 'LevelcimOrszag', 'LevelcimState', 'LevelcimISZ', 'Mail_Addr_District',
        'LevelcimVaros', 'LevelcimUtca', 'Mail_Addr_ps_type', 'Mail_Addr_housenr', 'Mail_Addr_building',
        'Mail_Addr_stairway', 'Mail_Addr_floor', 'Mail_Addr_door', 'Mail_Spec_Addr', 'Adoszam',
        'EURAdoszam', 'LicenseNumber', 'PenzforgJelz', 'Szlaszam', 'IBANCode',
        'SWIFT', 'BANK_ACC_ID', 'Telefon1', 'Telefon2', 'Telefon3',
        'Fax1', 'Fax2', 'Skype', 'OtherCommunication', 'Modem',
        'eMail', 'Internet', 'PartnerOsztaly', 'M2MC', 'M2UtolsoValtoztatas',
        'InCorporation_Date', 'Annual_Revenue', 'Annual_Revenue_Curr_ID', 'First_Order_Date', 'First_Offer_Requested',
        'Offer_Released', 'Insurance_max', 'Insurance_Max_Curr_ID', 'NumberOfEmployees', 'FIBUKontoKred',
        'FIBUKontoDeb', 'Sprache', 'ClassID1', 'Wahrung', 'ArfCode',
        'TeljDatumCode1', 'TeljDatumCode3', 'Credit_Payment_Deadline_Type', 'Debit_Payment_Deadline_Type', 'FizHat1',
        'FizMod', 'FizHat2', 'FizMod2', 'ClassID2', 'Wahrung2',
        'ArfCode2', 'TeljDatumCode2', 'TeljDatumCode4', 'ISOpontszam', 'UgyfelJeleKonyvelesben',
        'MegbizoIN', 'AlvallalkozoIN', 'PSpedIN', 'CimIN', 'Megjegyzesek',
        'SajatCegPartnerID', 'TelepNev1', 'TelepNev2', 'Site_Country_ID', 'TelepOrszag',
        'TelepState', 'TelepISZ', 'Site_Addr_District', 'TelepVaros', 'TelepUtca',
        'Site_Addr_ps_type', 'Site_Addr_housenr', 'Site_Addr_building', 'Site_Addr_stairway', 'Site_Addr_floor',
        'Site_Addr_door', 'Site_Spec_Addr', 'MCFremdsystem1', 'MCFremdsystem2', 'Zona',
        'CL_Category_ID', 'CL_Mon_Calc', 'CL_Mon_Inv', 'CL_Mon_Inv_Exp', 'CL_Mon_Cost',
        'CreditOsszegHUF', 'CreditOsszegEUR', 'CL_ModifiedBy', 'CL_ModificationDate', 'Discount',
        'Inv_FormatID', 'UseOwnTariff', 'M2UtolsoValtoztatas_UserID', 'Felvevo_UserID', 'Felvetel_Datuma',
        'RefNum01', 'RefNum02', 'RefNum03', 'Parent_Company_ID', 'Corporate_Group_ID',
        'Taxpayer_Type', 'ZusatzInt01', 'ZusatzInt02', 'ZusatzInt03', 'ZusatzInt04',
        'ZusatzInt05', 'ZusatzInt06', 'ZusatzInt07', 'ZusatzInt08', 'ZusatzInt09',
        'ZusatzInt10', 'ZusatzInt11', 'ZusatzInt12', 'ZusatzFloat01', 'ZusatzFloat02',
        'ZusatzFloat03', 'ZusatzFloat04', 'ZusatzFloat05', 'ZusatzFloat06', 'ZusatzFloat07',
        'ZusatzFloat08', 'ZusatzFloat09', 'ZusatzFloat10', 'ZusatzVarchar01', 'ZusatzVarchar02',
        'ZusatzVarchar03', 'ZusatzVarchar04', 'ZusatzVarchar05', 'ZusatzVarchar06', 'ZusatzVarchar07',
        'ZusatzVarchar08', 'ZusatzVarchar09', 'ZusatzVarchar10', 'ZusatzDate01', 'ZusatzDate02',
        'ZusatzDate03', 'ZusatzDate04', 'ZusatzDate05', 'ZusatzDate06', 'ZusatzDate07',
        'ZusatzDate08','ZusatzDate09', 'ZusatzDate10'
    ];

    protected $dates = [];
    protected $dateFormat = '';

    // Alapértékek
    protected $attributes = [];

    // Zárolt tulajdonságok
    protected $hidden = [];

    // Naplózandó mezők
    protected static $LogAttributes = [
        'TransactID', 'SzamlazasiCim', 'SzCimTipus', 'Nyitvatartas', 'RovidNev',
        'Nev1', 'Nev2', 'Cust_Old_Name', 'Country_ID', 'Orszag',
        'State', 'ISZ', 'District', 'Varos', 'Utca',
        'Addr_ps_type', 'Addr_housenr', 'Addr_building', 'Addr_stairway', 'Addr_floor',
        'Addr_door', 'Spec_Addr', 'SzNev1', 'SzNev2', 'Inv_Country_ID',
        'SzOrszag', 'SzState', 'SzISZ', 'Inv_Addr_District', 'SzVaros',
        'SzUtca', 'Inv_Addr_ps_type', 'Inv_Addr_housenr', 'Inv_Addr_building', 'Inv_Addr_stairway',
        'Inv_Addr_floor', 'Inv_Addr_door', 'Inv_Spec_Addr', 'Fopartner', 'RaktarFopartner',
        'Mail_Country_ID', 'LevelcimOrszag', 'LevelcimState', 'LevelcimISZ', 'Mail_Addr_District',
        'LevelcimVaros', 'LevelcimUtca', 'Mail_Addr_ps_type', 'Mail_Addr_housenr', 'Mail_Addr_building',
        'Mail_Addr_stairway', 'Mail_Addr_floor', 'Mail_Addr_door', 'Mail_Spec_Addr', 'Adoszam',
        'EURAdoszam', 'LicenseNumber', 'PenzforgJelz', 'Szlaszam', 'IBANCode',
        'SWIFT', 'BANK_ACC_ID', 'Telefon1', 'Telefon2', 'Telefon3',
        'Fax1', 'Fax2', 'Skype', 'OtherCommunication', 'Modem',
        'eMail', 'Internet', 'PartnerOsztaly', 'M2MC', 'M2UtolsoValtoztatas',
        'InCorporation_Date', 'Annual_Revenue', 'Annual_Revenue_Curr_ID', 'First_Order_Date', 'First_Offer_Requested',
        'Offer_Released', 'Insurance_max', 'Insurance_Max_Curr_ID', 'NumberOfEmployees', 'FIBUKontoKred',
        'FIBUKontoDeb', 'Sprache', 'ClassID1', 'Wahrung', 'ArfCode',
        'TeljDatumCode1', 'TeljDatumCode3', 'Credit_Payment_Deadline_Type', 'Debit_Payment_Deadline_Type', 'FizHat1',
        'FizMod', 'FizHat2', 'FizMod2', 'ClassID2', 'Wahrung2',
        'ArfCode2', 'TeljDatumCode2', 'TeljDatumCode4', 'ISOpontszam', 'UgyfelJeleKonyvelesben',
        'MegbizoIN', 'AlvallalkozoIN', 'PSpedIN', 'CimIN', 'Megjegyzesek',
        'SajatCegPartnerID', 'TelepNev1', 'TelepNev2', 'Site_Country_ID', 'TelepOrszag',
        'TelepState', 'TelepISZ', 'Site_Addr_District', 'TelepVaros', 'TelepUtca',
        'Site_Addr_ps_type', 'Site_Addr_housenr', 'Site_Addr_building', 'Site_Addr_stairway', 'Site_Addr_floor',
        'Site_Addr_door', 'Site_Spec_Addr', 'MCFremdsystem1', 'MCFremdsystem2', 'Zona',
        'CL_Category_ID', 'CL_Mon_Calc', 'CL_Mon_Inv', 'CL_Mon_Inv_Exp', 'CL_Mon_Cost',
        'CreditOsszegHUF', 'CreditOsszegEUR', 'CL_ModifiedBy', 'CL_ModificationDate', 'Discount',
        'Inv_FormatID', 'UseOwnTariff', 'M2UtolsoValtoztatas_UserID', 'Felvevo_UserID', 'Felvetel_Datuma',
        'RefNum01', 'RefNum02', 'RefNum03', 'Parent_Company_ID', 'Corporate_Group_ID',
        'Taxpayer_Type', 'ZusatzInt01', 'ZusatzInt02', 'ZusatzInt03', 'ZusatzInt04',
        'ZusatzInt05', 'ZusatzInt06', 'ZusatzInt07', 'ZusatzInt08', 'ZusatzInt09',
        'ZusatzInt10', 'ZusatzInt11', 'ZusatzInt12', 'ZusatzFloat01', 'ZusatzFloat02',
        'ZusatzFloat03', 'ZusatzFloat04', 'ZusatzFloat05', 'ZusatzFloat06', 'ZusatzFloat07',
        'ZusatzFloat08', 'ZusatzFloat09', 'ZusatzFloat10', 'ZusatzVarchar01', 'ZusatzVarchar02',
        'ZusatzVarchar03', 'ZusatzVarchar04', 'ZusatzVarchar05', 'ZusatzVarchar06', 'ZusatzVarchar07',
        'ZusatzVarchar08', 'ZusatzVarchar09', 'ZusatzVarchar10', 'ZusatzDate01', 'ZusatzDate02',
        'ZusatzDate03', 'ZusatzDate04', 'ZusatzDate05', 'ZusatzDate06', 'ZusatzDate07',
        'ZusatzDate08','ZusatzDate09', 'ZusatzDate10'
    ];

    // Naplózásból kihagyandó mezők
    protected static $ignoreChangedAttributes = array();

    // Csak a ténylegesen megváltozott mezőket naplózza
    protected static $logOnlyDirty = true;

    // Konvertálás
    protected $casts = array();

    // Kapcsolatok
    public function users()
    {
        return $this->hasMany('App\User', 'CompanyID', 'ID');
    }

    /**
     * ComapnyModel constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.company.' . session()->get('version'));
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    public function getSearchResult(): SearchResult
    {
        $a = Helper::getCompanyAndVersion();
        return new SearchResult(
            $this,
            $this->Nev1,
            route('companies.show', [
                'company' => $a['company'],
                'version' => $a['version'],
                'id' => $this->ID,
            ]));
    }
}
