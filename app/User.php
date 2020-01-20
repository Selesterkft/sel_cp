<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

//use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements Searchable
{
    use Notifiable;
    use HasRoles;
    use HasEvents;
    use SoftDeletes;
    use Auditable;
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logAttributes = [
        'TransactID', 'CompanyID', 'Supervisor_ID', 'Supervisor_Name',
        'Name', 'Email', 'password', 'language', 'last_login_at', 'last_login_ip'];

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
            'CompanyID')->select(['Nev1']);
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
        //if (! $this->exists) { return false; }

        $this->fill($attributes);

        //dd('User.update', $attributes, $this);

        //if( $this->fireModelEvent('saving') === false ){ return false; }

        $config = config('appConfig.tables.users');

        if( !empty($attributes['last_login_ip']) )
        {
            $res = \DB::connection($config['connection'])
                ->select(
                    \DB::connection()->raw('EXECUTE [dbo].[' . $config['register'] . '] ?, ?, ?, ?'),
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

        //$this->fireModelEvent('saved', false);

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
