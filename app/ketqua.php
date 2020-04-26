<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ketqua extends Model
{
    //
    protected $table = "ketqua";

    protected $fillable=[ 'id', 'dangtin_id', 'doidangtin', 'doibatdoi'];
}
