<?php

namespace App\Models\ver_2019_01;

use Illuminate\Database\Eloquent\Model;

class InvModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'Inv';
    protected $primaryKey = 'ID';
}
