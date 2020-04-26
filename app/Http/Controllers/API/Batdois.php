<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\batdoi;
use App\dangtin;
use App\doibong;
use App\thongbao;
use App\User;
use App\doibong_nguoidung;
use Response;
class Batdois extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return batdoi::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $batdoi = new batdoi;
        $batdoi->dangtin_id = $req->dangtin_id;
        $batdoi->doitimdoi_id = $req->doitimdoi_id;
        $batdoi->doibatdoi_id = $req->doibatdoi_id;
        $ngay = dangtin::find($req->dangtin_id)->created_at;
        $tentimdoi = doibong::find($req->doibatdoi_id)->ten;
        $tendangtin = doibong::find($req->doitimdoi_id)->ten;
        $batdoi->trangthai = 0;
        $batdoi->save();
        $thongbao = new thongbao;
        $thongbao->noidung = "Đội {$tentimdoi} muốn đá với đội {$tendangtin} của bạn ngày {$ngay}";
        $thongbao->user_id = doibong_nguoidung::where([["phanquyen_id",1],["doibong_id",$req->doitimdoi_id]])->first()->user_id;
        $thongbao->trangthai = 0;
        $c = User::find(doibong_nguoidung::where([["phanquyen_id",1],["doibong_id",$req->doitimdoi_id]])->first()->user_id)->device;
        $thongbao->device = $c;
        $thongbao->save();
        return Response::json([
            'type' => 'success',
            'title' => 'Thành công!',
            'content' => 'Bắt đối thành công, chờ phản hồi từ đội bạn',
            'doitruong_id' =>  $thongbao->user_id
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $a = batdoi::where("dangtin_id",$id)->get();
        // echo "[";
        // $sl = $a->count();
        // $sll = 0;
        $listdata = [];
        foreach ($a as $key => $value) {
            // $sll++;
            // echo $key;
            $z = doibong::find($value->doibatdoi_id);
            array_push($listdata,$z);
            // echo $z['id'];
            // if($sll != $sl) echo ",";
        }
        // echo "]";
        json_encode($listdata);
        foreach ($a as $key => $value) {
            $listdata[$key]['batdoi_id'] = $value->id;
        }
        json_encode($listdata);
        return $listdata;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $a = batdoi::find($id);
        $b = dangtin::find($a->dangtin_id);
        $b->doibatdoi_id = $a->doibatdoi_id;
        $b->save();
        $cacthanhvientimdoi = doibong::find($a->doitimdoi_id)->member->where('trangthai',1);
        $cacthanhvienbatdoi = doibong::find($a->doibatdoi_id)->member->where('trangthai',1);
        $tentimdoi=doibong::find($a->doitimdoi_id)->ten;
        $tenbatdoi=doibong::find($a->doibatdoi_id)->ten;
        for ($i=0; $i < $cacthanhvientimdoi->count(); $i++) { 
            $thongbao = new thongbao;
            $thongbao->noidung = "Bắt đối thành công với {$tenbatdoi}";
            $thongbao->user_id = $cacthanhvientimdoi[$i]->user_id;
            $thongbao->trangthai = 0;
            $c = User::find($cacthanhvientimdoi[$i]->user_id)->device;
            $thongbao->device = $c;
            $thongbao->save();
        }
        for ($i=0; $i < $cacthanhvienbatdoi->count(); $i++) { 
            $thongbao = new thongbao;
            $thongbao->noidung = "Bắt đối thành công với {$tentimdoi}";
            $thongbao->user_id = $cacthanhvienbatdoi[$i]->user_id;
            $thongbao->trangthai = 0;
            $c = User::find($cacthanhvienbatdoi[$i]->user_id)->device;
            $thongbao->device = $c;
            $thongbao->save();
        }
        $d = batdoi::where('dangtin_id',$a->dangtin_id)->delete();
        return Response::json([
                    'type' => 'success',
                    'title' => 'Thành công!',
                    'content' => 'Bắt đối thành công!',
                ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
