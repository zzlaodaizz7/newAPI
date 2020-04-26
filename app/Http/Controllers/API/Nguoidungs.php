<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Hash;

class Nguoidungs extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // *
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     
    // public function store(Request $req)
    // {
    //     //
    //     $nguoidung = new User;
    //     $nguoidung->email = $req->email;
    //     $nguoidung->ten = $req->ten;
    //     $nguoidung->matkhau = hash::make($req->matkhau);
    //     $nguoidung->sdt = $req->sdt;
    //     $nguoidung->anhbia = $req->anhbia;
    //     $nguoidung->save();
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return User::find($id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

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
        $nguoidung = User::find($id);
        $nguoidungupdate = $request->all();
        echo $nguoidung->update($nguoidungupdate);
        if ($request->matkhau) {
            $passnew = hash::make($request->matkhau);
            echo $nguoidung->matkhau = $passnew;
            $nguoidung->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['ten'] = $user->ten;
            $success['id']  = $user->id;
            return response()->json([
                'token' => $user->createToken('MyApp')-> accessToken,
                'ten'   => $user->ten,
                'id'    => $user->id,
                'email' => $user->email,
                'device'=> $user->device,
                'sdt'   => $user->sdt,
                'anhbia'=> $user->anhbia,
                'created_at'=>$user->created_at
                                    ], $this-> successStatus); 
        }
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }
    public function register(Request $request) 
    { 
        // echo $request;
        $validator = Validator::make($request->all(), [ 
            'ten' => 'required', 
            'email' => 'required|email', 
            'password' => 'required',
            // 'c_password' => 'required|same:matkhau', 
        ],
        [   
            'ten.required'      => 'Tên không được để trống!',
            'email.email'       => 'Sai định dạng email!',
            'email.required'    => 'Email không được để trống!'
        ]
        );
        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
        $input = $request->all(); 
                $input['password'] = bcrypt($input['password']); 
                $user = User::create($input); 
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                $success['ten'] =  $user->ten;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}
