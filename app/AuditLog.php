<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public $connection = 'azure';
    public $table = 'audit_logs';

    protected $fillable = [
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
    ];

    protected $casts = [
        'properties' => 'collection',
    ];

    /**
     * AuditLog constructor.
     * @param string $connection
     */
    public function __construct()
    {
        $config = config('appConfig.tables.audit_logs');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }
}
