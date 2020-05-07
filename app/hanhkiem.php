<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hanhkiem extends Model
{
    //
    protected $table = "hanhkiem";
    protected $fillable = ['id','user_id','doiduocvote_id','hanhkiem'];
}
