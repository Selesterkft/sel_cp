<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

class ModelBase extends \Eloquent
{
    public static function getChecksum($data)
    {
        $val = '';

        foreach( $data->getFillable() as $fill )
        {
            $val .= $data->$fill . config('appConfig.checksum_separator');
        }

        $val = substr($val, 0, -1);

        $ret = Uuid::uuid5(Uuid::NAMESPACE_X500, $val)->toString();

        return $ret;
    }
}