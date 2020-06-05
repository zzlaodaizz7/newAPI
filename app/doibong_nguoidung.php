<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doibong_nguoidung extends Model
{
    //
    protected $table = "doibong_nguoidung";

    protected $fillable=[ 'id', 'doibong_id', 'user_id', 'phanquyen_id','trangthai'];
}
