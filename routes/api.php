<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//////////
Route::post('login', 'API\Nguoidungs@login');
Route::post('register', 'API\Nguoidungs@register');
Route::group(['middleware' => 'auth:api'], function(){
	
});
Route::resource('batdoi','API\Batdois');
Route::resource('dangtin','API\Dangtins');
Route::resource('thanhvien','API\DoibongNguoidung');
Route::resource('doibong','API\Doibongs');
Route::resource('nguoidung','API\Nguoidungs');
Route::resource('sanbong','API\Sanbongs');
Route::resource('khunggio','API\Khunggios');
Route::get('danhsachdangtin','API\Chitietdoibongs@dsdangtin');
// Route::resource('phanquyen','API\PhanQuyens');
Route::get('chitietdoibong/{id}','API\Chitietdoibongs@chitiet');
Route::get('danhsachthanhvien/{id}','API\Chitietdoibongs@dsthanhvien');
Route::get('doitruongcacdoi/{id}','API\Chitietdoibongs@list');
Route::resource('ketqua','API\ketquas');
Route::get('cacdoidathamgia/{id}','API\Chitietdoibongs@cacdoidathamgia');
Route::get('cactindadang/{id}','API\Chitietdoibongs@cactindadang');
Route::post('upload', 'API\UploadImage@upload');
Route::get("cactransapdienra/{id}","API\Chitietdoibongs@cactransapdienra");
Route::get("cactransapdienracuadoi/{id}","API\Chitietdoibongs@cactransapdienracuadoi");
Route::get("cactrandaketthuc/{id}","API\Chitietdoibongs@cactrandaketthuc");
Route::post("voteketqua","API\Chitietdoibongs@voteketqua");