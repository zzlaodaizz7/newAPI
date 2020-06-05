<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\doibong;
use App\doibong_nguoidung;
use App\doibong_khunggio;
use Response;
class Doibongs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return doibong::all();
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
        //
        // echo ($req->arrGio[2]);
        $doibong = new doibong;
        $doibong->ten = $req->ten;
        $doibong->trinhdo = $req->trinhdo;
        $doibong->diachi = $req->diachi;
        $doibong->sdt = $req->sdt;
        $doibong->save();
        $doibongFisrt = doibong::orderByDesc('id')->first();
        for ($i=0; $i < count($req->arrGio); $i++) {
            $b = new doibong_khunggio;
            $b->doibong_id = $doibongFisrt->id;
            $b->khunggio_id = $req->arrGio[$i];
            $b->save();
        }
        $a = new doibong_nguoidung;
        $a->doibong_id = $doibongFisrt->id;
        $a->user_id = $req->user_id;
        $a->phanquyen_id = 1;
        $a->trangthai = 1;
        if($a->save()){
            return Response::json([
                'type' => 'success',
                'title' => 'Thành công!',
                'content' => 'Tạo đội thành công!',
            ]);
        }else{
            return Response::json([
                'type' => 'error',
                'title' => 'Lỗi!',
                'content' => 'Xin vui lòng thử lại sau!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return doibong::find($id)->member->where('trangthai',0);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req,$id)
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
        $doibong = doibong::find($id);
        $doibong->ten = $request->ten;
        $doibong->trinhdo = $request->trinhdo;
        $doibong->diachi = $request->diachi;
        $doibong->sdt = $request->sdt;
        $doibong->save();
        $xoa = doibong_khunggio::where('doibong_id',$id)->delete();
        for ($i=0; $i < count($request->arrGio); $i++) { 
            $b = new doibong_khunggio;
            $b->doibong_id = $id;
            $b->khunggio_id = $request->arrGio[$i];
            $b->save();
        }
        return 1;
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
        doibong::find($id)->delete();
    }
}
