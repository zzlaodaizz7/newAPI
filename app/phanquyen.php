<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phanquyen extends Model
{
    //
    protected $table = "phanquyen";

    protected $fillable=[ 'id', 'ten'];
}
