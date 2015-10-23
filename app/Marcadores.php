<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcadores extends Model
{
    protected $table='marcadores';

    protected $fillable=['dnschecker_id','coordx','coordy'];
}
