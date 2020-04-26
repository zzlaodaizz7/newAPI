<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\doibong_nguoidung;
use Response;
class DoibongNguoidung extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return doibong_nguoidung::all();
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
        $a = new doibong_nguoidung;
        $a->doibong_id = $req->doibong_id;
        $a->user_id = $req->user_id;
        $a->phanquyen_id = 0;
        $a->trangthai = 0;
        if ($a->save()) {
            return Response::json([
                    'type' => 'success',
                    'title' => 'Thành công!',
                    'content' => 'Xin vào đội thành công!',
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
        //
        
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
        $a = doibong_nguoidung::find($id);
        $a->trangthai = 1;
        if($a->save()){
            return Response::json([
                'type' => 'success',
                'title' => 'Thành công!',
                'content' => 'Thêm thành viên thành công!',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $a = doibong_nguoidung::find($id)->delete();
        return Response::json([
            'type' => 'success',
            'title' => 'Thành công!',
            'content' => 'Xóa thành viên thành công!',
        ]);
        
    }
}
