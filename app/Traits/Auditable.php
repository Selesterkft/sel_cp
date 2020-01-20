<?php

namespace App\Traits;

use App\AuditLog;
use Illuminate\Database\Eloquent\Model;

trait Auditable
{
    public static function bootAuditable()
    {
        //parent::boot();

        //dd('Auditable.bootAuditable', static::class);
        if( static::class == 'App\Models\VersionModel')
        {
            dd('Auditable.bootAuditable', static::class);
        }
/*
        static::booting(function(Model $model)
        {
            dd('bootAuditable.booting');
        });
*/
        /*
        // Belépés az "index" oldalra
        static::retrieved(function(Model $model)
        {
            dd('bootAuditable.retrieved');
        });
        */

        // Mentés kezdete
        static::saving(function(Model $model)
        {
            dd('bootAuditable.saving', static::class);
        });


        // Mentés vége
        static::saved(function(Model $model)
        {
            dd('bootAuditable.saved', static::class);
        });

        static::creating(function (Model $model) {
            dd('bootAuditable.creating');
            self::audit('creating', $model);
        });

        static::created(function (Model $model) {
            dd('bootAuditable.created');
            self::audit('created', $model);
        });

        static::updating(function (Model $model) {
            dd('Auditable.bootAuditable.updating');
            self::audit('updating', $model);
        });

        static::updated(function (Model $model) {
            dd('Auditable.bootAuditable.updated');
            self::audit('updated', $model);
        });

        static::deleting(function (Model $model) {
            dd('bootAuditable.deleting');
            self::audit('deleting', $model);
        });

        static::deleted(function (Model $model) {
            dd('bootAuditable.deleted');
            self::audit('deleted', $model);
        });

        static::replicating(function (Model $model) {
            dd('bootAuditable.replicating');
            self::audit('replicating', $model);
        });
    }

    protected static function audit($description, $model)
    {
        dd('Auditable.audit', $description, $model);
        AuditLog::create([
            'description'  => $description,
            'subject_id'   => $model->id ?? null,
            'subject_type' => get_class($model) ?? null,
            'user_id'      => auth()->id() ?? null,
            'properties'   => $model ?? null,
            'host'         => request()->ip() ?? null,
        ]);
    }
}
