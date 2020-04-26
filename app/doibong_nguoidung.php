<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doibong_nguoidung extends Model
{
    //
    protected $table = "doibong_nguoidung";

    protected $fillable=[ 'id', 'doibong_id', 'nguoidung_id', 'phanquyen_id','trangthai'];
}
