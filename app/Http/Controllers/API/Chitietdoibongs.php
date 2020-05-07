<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\doibong;
use App\doibong_nguoidung;
use App\User;
use App\dangtin;
use Carbon\Carbon;
use Response;
use App\thongbao;
use App\ketqua;
class Chitietdoibongs extends Controller
{
    //
    public function chitiet($id){
    	return doibong::find($id);
    }
    public function dsthanhvien($id){
    	// $a = doibong_nguoidung::where([['doibong_id',$id],['trangthai',1]])->get();
     //    $listdata=[];
     //    foreach ($a as $key => $value) {
     //        $z = User::find($value->user_id);
     //        array_push($listdata,$z);
     //    }
     //    json_encode($listdata);
     //    foreach ($a as $key => $value) {
     //        $listdata[$key]['phanquyen_id'] = $value->phanquyen_id;
     //    }
     //    json_encode($listdata);   
     //    return $listdata;
        $a = doibong_nguoidung::where('doibong_id',$id)->get();
        $list = [];
        foreach ($a as $key => $value){
            array_push($list, $value);
        }
        foreach ($a as $key => $value){
            $list[$key]['user'] = User::find($value->user_id);
        }
        json_encode($list);
        return $list;

    }
    public function list($id){
    	$a = doibong_nguoidung::where([['user_id',$id],['phanquyen_id',1]])->get();
    	echo "[";
    	$sl = $a->count();
    	$sll = 0;
    	foreach ($a as $key => $value) {
    		$sll++;
    		echo doibong::find($value->doibong_id);
    		if($sll != $sl) echo ",";
    	}
    	echo "]";
    }
    public function cacdoidathamgia($id){
        $a = doibong_nguoidung::where('user_id',$id)->get('doibong_id');
        $sl = $a->count();
        echo "[";
        $sll = 0;
        foreach ($a as $key => $value) {
            $sll++;
            echo doibong::find($value->doibong_id);
            if($sll != $sl) echo ",";
        }
        echo "]";
    }

    public function cactindadang($id){
        return dangtin::where("doidangtin_id",$id)->get();
    }
    public function dsdangtin(){
        $b = Carbon::today()->toDateString();
        $a = dangtin::where([['ngay',">=",$b],["doibatdoi_id",-1]])->orderBy("ngay","ASC")->get();
        return $a;       
    }
    public function cactransapdienra($id){
        $a = doibong_nguoidung::where("user_id",$id)->get();
        $b = Carbon::today()->toDateString();
        $listdata=[];
        foreach ($a as $key => $value) {
            $z = dangtin::where([['ngay',">=",$b],["doidangtin_id",$value->doibong_id],["doibatdoi_id","!=",-1]])->get();
            foreach ($z as $key1 => $value1) {
                array_push($listdata,$z[$key1]);
            }
        }
        foreach ($a as $key => $value) {
            $z = dangtin::where([['ngay',">=",$b],["doibatdoi_id",$value->doibong_id]])->get();
            foreach ($z as $key1 => $value1) {
                array_push($listdata,$z[$key1]);
            }
        }
        json_encode($listdata);
        foreach ($listdata as $key => $value) {
                $listdata[$key]['doibong1'] = doibong::find($value->doidangtin_id);
                $listdata[$key]['doibong2'] = doibong::find($value->doibatdoi_id);
        }
        json_encode($listdata);
        return $listdata;
    }
    public function cactransapdienracuadoi($id){
        $listdata=[];
        $b = Carbon::today()->toDateString();
        $a = dangtin::where([['ngay',">=",$b],["doidangtin_id",$id],["doibatdoi_id","!=",-1]])->get();
        $c = dangtin::where([['ngay',">=",$b],["doibatdoi_id",$id]])->get();
        foreach ($a as $key => $value) {
            array_push($listdata, $a[$key]);
        }
        foreach ($c as $key => $value) {
            array_push($listdata, $c[$key]);
        }
        json_encode($listdata);
        foreach ($listdata as $key => $value){
            $listdata[$key]['doibong1'] = doibong::find($value->doidangtin_id);
            $listdata[$key]['doibong2'] = doibong::find($value->doibatdoi_id);
        }
        json_encode($listdata);   
        return $listdata;
    }
    public function cactrandaketthuc($id){
        $listdata=[];
        $b = Carbon::today()->toDateString();
        $a = dangtin::where([['ngay',"<",$b],["doidangtin_id",$id],["doibatdoi_id","!=",-1]])->get();
        $c = dangtin::where([['ngay',"<",$b],["doibatdoi_id",$id]])->get();
        foreach ($a as $key => $value) {
            array_push($listdata, $a[$key]);
        }
        foreach ($c as $key => $value) {
            array_push($listdata, $c[$key]);
        }
        json_encode($listdata);

        foreach ($listdata as $key => $value){
            $d = ketqua::where("dangtin_id",$value->id)->first();
            if ($d) {
                $listdata[$key]['banthangdoidangtin'] = $d->doidangtin;
                $listdata[$key]['banthangdoibatdoi'] = $d->doibatdoi;
            }
            $listdata[$key]['doibong1'] = doibong::find($value->doidangtin_id);
            $listdata[$key]['doibong2'] = doibong::find($value->doibatdoi_id);

        }
        json_encode($listdata);   
        return $listdata;
    }
    public function voteketqua(Request $req){
        $a = new ketqua;
        $a->dangtin_id  = $req->dangtin_id;
        $a->doidangtin  = $req->doidangtin;
        $a->doibatdoi   = $req->doibatdoi;
        $b = dangtin::find($req->dangtin_id);
        $b->voted = 1;
        if ($req->doidangtin > $req->doibatdoi) {
            $c = doibong::find(dangtin::find($req->dangtin_id)->doidangtin_id);
            $c->sodiem = $c->sodiem+3;
            $c->save();
        }else if($req->doidangtin < $req->doibatdoi){
            $c = doibong::find(dangtin::find($req->dangtin_id)->doibatdoi_id);
            $c->sodiem = $c->sodiem+3;
            $c->save();
        }else{
            $c = doibong::find(dangtin::find($req->dangtin_id)->doidangtin_id);
            $c->sodiem = $c->sodiem+1;
            $c->save();
            $d = doibong::find(dangtin::find($req->dangtin_id)->doibatdoi_id);
            $d->sodiem = $c->sodiem+1;
            $d->save();
        }
        $b->save();
        $a->save();
        return Response::json([
            'type' => 'success',
            'title' => 'Thành công!',
            'content' => 'Vote thành công',
        ]);
    }
    public function bangxephang(){
        return doibong::orderBy("sodiem","DESC")->get();
    }
    public function thongbao($id){
        return thongbao::where("user_id",$id)->orderBy("created_at","DESC")->get();
    }
}
