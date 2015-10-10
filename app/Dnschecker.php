<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dnschecker extends Model
{
    protected $table='dnschecker';

    protected $fillable=['company','ip','country'];
}
