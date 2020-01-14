<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements Searchable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use LogsActivity;

    protected $connection = 'azure';
    protected $table = 'CP_Users';
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TransactID', 'CompanyID', 'Supervisor_ID', 'Supervisor_Name',
        'Name', 'Email', 'password', 'language', 'last_login_at', 'last_login_ip'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /* =========================================================
     * Activity Log
     * =========================================================
     */
    //
    protected static $logFillable = true;
    // Naplózandó mezők
    //protected static $logAttributes = [
    //    'CompanyID', 'Supervisor_ID', 'Supervisor_Name', 'Name', 'Email', 'password', 'language'
    //];

    // Naplózandó események
    //protected static $recordEvents = [
    //    'created', 'updated', 'deleted'
    //];

    // Naplózásból kihagyandó mezők
    //protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];

    // Csak a ténylegesen megváltozott mezőket naplózza
    //protected static $logOnlyDirty = true;
    // =========================================================

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * User constructor.
     * @param string $connection
     */
    public function __construct()
    {
        parent::__construct();

        $config = config('appConfig.tables.users');
        //dd('User.construct', $config['table'], $config['connection'], $config);
        $this->table = $config['table'];
        $this->connection = $config['connection'];
    }

    public function company()
    {
        $res = $this->hasOne(
            '\App\Models\\' . session()->get('version') . '\CompanyModel',
            'ID',
            'CompanyID');
        return $res;
    }

    public function CreateUser($request)
    {
        $parameters = $request;

        $parameters['Supervisor_Name'] = (empty($parameters['Supervisor_Name'])) ? '' : empty($parameters['Supervisor_Name']);

        $config = config('appConfig.tables.users');
        $res = \DB::connection($config['connection'])
            ->select(\DB::connection($config['connection'])
                ->raw('EXECUTE dbo.' . $config['insert'] . ' ?, ?, ?, ?, ?, ?, ?, ?'),
            [
                $parameters['CompanyID'],
                $parameters['Supervisor_ID'],
                $parameters['Supervisor_Name'],
                $parameters['Name'],
                $parameters['Email'],
                $parameters['password'],
                $parameters['language'],
                \App\Classes\Helper::get_timestamp()
            ]);

        $user = User::find($res[0]->ID);

        return $user;
    }

    public function update(array $attributes = [], array $options = [])
    {
        //dd('User.update', $attributes, $this);
        if (! $this->exists) {
            return false;
        }

        $config = config('appConfig.tables.users');

        if( !empty($attributes['last_login_ip']) )
        {
            $res = \DB::connection($config['connection'])
                ->select(
                    \DB::connection()->raw('EXECUTE CP_User_Register_Login ?, ?, ?, ?'),
                [
                    $this->ID,
                    $attributes['last_login_ip'],
                    $attributes['last_login_at'],
                    \App\Classes\Helper::get_timestamp()
                ]);
        }
        else
        {
            $res = \DB::connection($config['connection'])
                ->select(\DB::connection($config['connection'])
                    ->raw('EXECUTE [dbo].[' . $config['update'] . '] ?, ?, ?, ?, ?'),
                    [
                        $attributes['ID'],
                        $attributes['Name'],
                        $attributes['Email'],
                        $attributes['language'],
                        \App\Classes\Helper::get_timestamp()
                    ]);
        }
        return $res;
    }

    public function restore($id = null)
    {
        if( empty($id) )
        {
            $id = $this->ID;
        }

        $config = config('appConfig.tables.users');
        $res = \DB::connection($config['connection'])
            ->select(\DB::connection($config['connection'])
                ->raw("EXECUTE [dbo].[{$config['restore']}] ?, ?"), [
                    $id,
                    \App\Classes\Helper::get_timestamp()
            ]);
        return $res;
    }

    public function getSearchResult(): SearchResult
    {
        //$a = Helper::getCompanyAndVersion();
        return new SearchResult($this, $this->Name, route('users.show'));
    }
}
