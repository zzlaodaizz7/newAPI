<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\dangtin;
use Response;
class Dangtins extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $a = dangtin::where([
            ['doidangtin_id','=',$req->doidangtin_id],
            ['ngay','=',$req->ngay],
            ['khunggio_id','=',$req->khunggio_id]
        ])->count();
        if ($a != 0) {
            return Response::json([
                'type' => 'error',
                'title' => 'Lỗi!',
                'content' => 'Đăng tin trùng ngày và khung giờ',
            ]);
        }else{
            $dangtin = new dangtin;
            $dangtin->doidangtin_id = $req->doidangtin_id;
            $dangtin->ngay = $req->ngay;
            $dangtin->keo = $req->keo;
            $dangtin->san_id = $req->san_id;
            $dangtin->khunggio_id = $req->khunggio_id;
            if ($dangtin->save()) {
                return Response::json([
                    'type' => 'success',
                    'title' => 'Thành công!',
                    'content' => 'Đăng tin thành công',
                ]);
            };
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
        return dangtin::find($id)->batdoi;
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
        $dangtin = dangtin::find($id);
        $dangtin->doibatdoi_id = $request->doibatdoi_id;
        $dangtin->save();
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
        $a = dangtin::find($id)->delete();
        return Response::json([
            'type' => 'success',
            'title' => 'Thành công!',
            'content' => 'Xóa thành công',
        ]);
    }
}
