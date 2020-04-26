<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\doibong;
use App\doibong_nguoidung;
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
        $doibong = new doibong;
        $doibong->ten = $req->ten;
        $doibong->trinhdo = $req->trinhdo;
        $doibong->diachi = $req->diachi;
        $doibong->sdt = $req->sdt;
        $doibong->save();
        $a = new doibong_nguoidung;
        $doibongFisrt = doibong::orderByDesc('id')->first();
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
        $doibong->hanhkiem = $request->hanhkiem;
        $doibong->sodiem = $request->sodiem;
        $doibong->save();
        $doibongupdate = $request->all();
        $doibong->update($doibongupdate);

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
