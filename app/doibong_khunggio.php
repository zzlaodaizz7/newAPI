<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doibong_khunggio extends Model
{
    //
    protected $table = 'doibong_khunggio';
    protected $fillable = ['id','doibong_id','khunggio_id'];
}
