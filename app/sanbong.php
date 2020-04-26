<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sanbong extends Model
{
    //
    protected $table = "sanbong";
    protected $fillable=[ 'id', 'songuoi','diachi','mota','sdt','ten','link'];
}
