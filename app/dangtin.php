<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dangtin extends Model
{
    //
    protected $table = "dangtin";
    protected $fillable=[ 'id','doidangtin_id', 'doibatdoi_id', 'san_id', 'khunggio_id', 'ngay','keo','voted' ];
    public function batdoi()
	{
	    return $this->hasMany('App\batdoi');
	}
}

