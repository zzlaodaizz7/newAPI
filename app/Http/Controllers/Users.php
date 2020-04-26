<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class Users extends Controller
{
    //
	function detailUser($id){
		return User::find($id);
	}
	
}
