<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batdoi extends Model
{
    //
    protected $table = "batdoi";

    protected $fillable=[ 'id','id_dangtin', 'id_doibatdoi', 'id_doitimdoi', 'trangthai'];
}
