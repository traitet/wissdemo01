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
//================================================================
// CHART
//================================================================
Route::get('chart', function () {

    $postId = 1;
    $getPost = DB::select(
       'select TOP 10 * from TMIFIO'
    );

    // $getPost;
    // json_encode($getPost);
    //dd($getPost);
    return json_encode($getPost);

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


//============================================================
// E-MFG DB connection name: default connection
//============================================================

// http://127.0.0.1:8000/api/interface_sap_po
Route::get('interface_sap_po', function () {
    $result = DB::select("EXEC interface_sap_po '20190101','20220101','',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_po/PO19000483  /PO21004645
Route::get('interface_sap_po/{doc_num}', function ($doc_num) {
    $result = DB::select("EXEC interface_sap_po '20190101','20220101','$doc_num',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_rec
Route::get('interface_sap_rec', function () {
    $result = DB::select("EXEC interface_sap_rec '20190101','20220101','',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_rec/PO19002270
Route::get('interface_sap_rec/{doc_num}', function ($doc_num) {
    $result = DB::select("EXEC interface_sap_rec '20190101','20220101','$doc_num',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_inv
Route::get('interface_sap_inv', function () {
    $doc_num = 'PO19000483';
    $result = DB::select("EXEC interface_sap_inv '20190101','20220101', '$doc_num' ,100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_inv/PO19000483
Route::get('/interface_sap_inv/{doc_num}', function ($doc_num) {
    $result = DB::select("EXEC interface_sap_inv '20190101','20220101','$doc_num',100");
    return json_encode($result);
});


//============================================================
// E-MFG DB connection name: sqlsrv_shipping_db
//============================================================
Route::get('emfg_shipping_order_status', function () {
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_order_status '20190101','20220101','',100");
    //DB::connection('mysql2')->select("");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/emfg_shipping_order_status/ xxxxxxxxx
Route::get('emfg_shipping_order_status/{doc_num}', function ($doc_num) {
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_order_status '20190101','20220101','$doc_num',100");
    return json_encode($result);
});

Route::get('emfg_shipping_log_ok', function () {
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ok '20190101','20220101','',100");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/emfg_shipping_log_ok/ xxxxxxxxx
Route::get('emfg_shipping_log_ok/{doc_num}', function ($doc_num) {
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ok '20190101','20220101','$doc_num',100");
    //DB::connection('mysql2')->select("");
    return json_encode($result);
});

Route::get('emfg_shipping_log_ng', function () {
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ng '20190101','20220101','',100");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/emfg_shipping_log_ng/ xxxxxxxxx
Route::get('emfg_shipping_log_ng/{doc_num}', function ($doc_num) {
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ng '20190101','20220101','$doc_num',100");
    //DB::connection('mysql2')->select("");
    return json_encode($result);
});

Route::get('emfg_shipping_log_event', function () {
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_event '20190101','20220101','',100");
    //DB::connection('mysql2')->select("");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/emfg_shipping_log_event/ xxxxxxxxx
Route::get('emfg_shipping_log_event/{doc_num}', function ($doc_num) {
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_event '20190101','20220101','$doc_num',100");
    //DB::connection('mysql2')->select("");
    return json_encode($result);
});


//============================================================
// EPS DB connection name: sqlsrv_eps_db
//============================================================
Route::get('eps_interface_pr_po_to_planner/', function () {
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC eps_interface_pr_po_to_planner '20190101','20220101','',100");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/eps_interface_pr_po_to_planner/ xxxxxxxxx
Route::get('eps_interface_pr_po_to_planner/{doc_num}', function ($doc_num) {
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC eps_interface_pr_po_to_planner '20190101','20220101','$doc_num',100");
    return json_encode($result);
});

Route::get('eps_interface_sap_pr_outstanding', function () {
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC eps_interface_sap_pr_outstanding '20190101','20220101','',100");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/eps_interface_sap_pr_outstanding/ xxxxxxxxx
Route::get('eps_interface_sap_pr_outstanding/{doc_num}', function ($doc_num) {
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC eps_interface_sap_pr_outstanding '20190101','20220101','$doc_num',100");
    return json_encode($result);
});

Route::get('report_budget_checking/', function () {
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC report_budget_checking '20190101','20220101','',100");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/report_budget_checking/ xxxxxxxxx
Route::get('report_budget_checking/{doc_num}', function ($doc_num) {
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC report_budget_checking '20190101','20220101','$doc_num',100");
    return json_encode($result);
});



