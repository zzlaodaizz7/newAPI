<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dangtin extends Model
{
    //
    protected $table = "dangtin";
    protected $fillable=[ 'id','id_doitimdoi', 'doibatdoi', 'id_san', 'id_khunggio', 'ngay','keo','voted' ];
    public function batdoi()
	{
	    return $this->hasMany('App\batdoi');
	}
}

