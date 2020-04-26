<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thongbao extends Model
{
    //
    protected $table = "thongbao";

    protected $fillable=[ 'id', 'noidung','id_nguoidung','loaithongbao','device'];
}
