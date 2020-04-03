<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

use DB;
use App\Classes\Helper;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class CompanyModel extends \Eloquent implements Searchable
{
    protected $connection, $table;
    protected $primaryKey = 'ID';
    protected $fillable = ['Nev1'];

    /**
     * ComapnyModel constructor.
     */
    public function __construct()
    {
        //$config = config('appConfig.tables.company.' . session()->get('version'));
        $config = config('appConfig.tables.company');

        $this->connection = $config['connection'];

        //$this->table = $config['table'];
        $this->table = $config['read'];
    }

    //protected $dates = [];
    //protected $dateFormat = '';

    // Alapértékek
    //protected $attributes = [];

    // Zárolt tulajdonságok
    //protected $hidden = [];

    // Naplózandó mezők
    //protected static $LogAttributes = ['Nev1'];

    // Naplózásból kihagyandó mezők
    //protected static $ignoreChangedAttributes = array();

    // Csak a ténylegesen megváltozott mezőket naplózza
    //protected static $logOnlyDirty = true;

    // Konvertálás
    //protected $casts = array();

    // Kapcsolatok
    public function users()
    {
        return $this->hasMany('App\User', 'CompanyID', 'ID');
    }

    public static function readAll()
    {
        $config = config('appConfig.tables.company.' . session('version'));
/*
        $companies = DB::connection($config['connection'])
            ->table($config['read'])
            ->select(['ID', 'Nev1'])
            ->get();
*/
        $companies = self::get(['ID', 'Nev1']);

        return $companies;
    }

    public function getByID(int $id) : CompanyModel
    {
        $config = config('appConfig.tables.company');
        $instance = new CompanyModel();

        $eloquent_builder = new Builder(
            DB::connection($config['connection'])
                ->table($config['read'])
                ->select(['ID', 'Nev1'])
                ->find($id)
        );
        $eloquent_builder->setModel($instance);
        $company = $eloquent_builder->get();
        dd('CompanyModel.getByID', $company);
        return $company;
    }

    public function save(array $options = [])
    {
        //
    }

    public function update(array $attributes = [], array $options = [])
    {
        //
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
