<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thongbao extends Model
{
    //
    protected $table = "thongbao";

    protected $fillable=[ 'id', 'noidung','user_id','loaithongbao','device'];
}
