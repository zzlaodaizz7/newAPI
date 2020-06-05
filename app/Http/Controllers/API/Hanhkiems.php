<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\hanhkiem;
use Response;
use App\doibong;
class Hanhkiems extends Controller
{
    //
    public function hanhkiem(Request $req){
    	$a = new hanhkiem;
    	$a->user_id = 0;
    	$a->doiduocvote_id = $req->doiduocvote_id;
    	$a->hanhkiem = $req->hanhkiem;
    	$a->save();

    	$b = hanhkiem::where("doiduocvote_id",$req->doiduocvote_id)->get();
    	$sodiem = 0;
    	foreach ($b as $key => $value) {
    		$sodiem+= $value->hanhkiem;
    	}

    	$c = doibong::find($req->doiduocvote_id);
    	$c->hanhkiem = round($sodiem/count($b));
    	$c->save();
    	return Response::json([
	        'type' => 'success',
	        'title' => 'Thành công!',
	        'content' => 'Vote thành công!'
        ]);
    }
}
