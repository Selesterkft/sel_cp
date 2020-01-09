<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySubdomainModel extends Model
{
    use SoftDeletes;
    
    protected $connection = 'azure', 
            $table = 'company_has_subdomain', 
            $primaryKey = 'id', 
            $fillable = ['CompanyID', 'CompanyName', 'CompanyNickName', 'SubdomainName'];
            
    
    
    function __construct() 
    {
        $config = config('appConfig.tables.company_has_subdomain');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

}
