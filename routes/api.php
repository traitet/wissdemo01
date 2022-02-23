<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\facades\DB;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ==============================================================
// ADD WEB API
// ==============================================================
Route::resource('photos', 'App\Http\Controllers\PhotoController');
Route::resource('wiss-apis', 'App\Http\Controllers\WissApiController');

Route::get('call-procedure', function () {

    $postId = 1;
    $getPost = DB::select(
       'EXEC sp011'
    );

    dd($getPost);

});

Route::get('a', function () {

    $postId = 1;
    $getPost = DB::select(
       'select TOP 10 * from TMIFIO'
    );

    // $getPost;
    // json_encode($getPost);
    dd($getPost);

});

// ================================================================
// TEST
// ================================================================
Route::get('sp1', function () {
    $result = DB::select("EXEC interface_sap_po '20190101','20220101','',100");
    return json_encode($result);
});

Route::get('sp2', function () {
    $result = DB::select("EXEC interface_sap_rec '20190101','20220101','',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/sp3
Route::get('sp3', function () {
    $result = DB::select("EXEC interface_sap_inv '20190101','20220101','',100");
    return json_encode($result);
});


// ================================================================
// WEB API FROM SIAM_EPSINFDB
// ================================================================

// http://127.0.0.1:8000/api/interface_sap_po
Route::get('interface_sap_po', function () {
    $result = DB::select("EXEC interface_sap_po '20190101','20220101','',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_po/PO19000483
Route::get('interface_sap_po/{doc_num}', function ($doc_num) {
    $result = DB::select("EXEC interface_sap_po '20190101','20220101',$doc_num,100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_rec
Route::get('interface_sap_rec', function () {
    $result = DB::select("EXEC interface_sap_rec '20190101','20220101','',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_rec/PO19002270
Route::get('interface_sap_rec/{doc_num}', function ($doc_num) {
    $result = DB::select("EXEC interface_sap_rec '20190101','20220101',$doc_num,100");
    return json_encode($result);
});


// http://127.0.0.1:8000/api/interface_sap_inv
Route::get('interface_sap_inv', function () {
    $doc_num = 'PO19000483';
    $result = DB::select("EXEC interface_sap_inv '20190101','20220101', $doc_num ,100");
    return json_encode($result);
});


// http://127.0.0.1:8000/api/interface_sap_inv/PO19000483
Route::get('/interface_sap_inv/{doc_num}', function ($doc_num) {
    $result = DB::select("EXEC interface_sap_inv '20190101','20220101',$doc_num,100");
    return json_encode($result);
});



