<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dnschecker extends Model
{

  public function position()
    {
        return $this->hasOne('App\Marcadores');
    }

    protected $table='dnschecker';

    protected $fillable=['company','ip','country'];
}
