<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doibong extends Model
{
    //
    protected $table = "doibong";
    protected $fillable =[ 'id','ten','songuoi','diachi','mota','sdt','trinhdo','anhdaidien','anhbia'];
    public function member()
	{
	    return $this->hasMany('App\doibong_nguoidung');
	}
}

