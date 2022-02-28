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

#region [INTIAL CODE WHEN GERNATE]
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// =========================================================================================================================
// ADD WEB API
// =========================================================================================================================
Route::resource('photos', 'App\Http\Controllers\PhotoController');
Route::resource('wiss-apis', 'App\Http\Controllers\WissApiController');

#endregion

#region [TEST CALL API]
// =========================================================================================================================
// TEST SP1,SP2,SP3
// =========================================================================================================================
// http://127.0.0.1:8000/api/sp1
Route::get('sp1', function () {
    $result = DB::select("EXEC interface_sap_po '20190101','20220101','',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/sp2
Route::get('sp2', function () {
    $result = DB::select("EXEC interface_sap_rec '20190101','20220101','',100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/sp3
Route::get('sp3', function () {
    $result = DB::select("EXEC interface_sap_inv '20190101','20220101','',100");
    return json_encode($result);
});
#endregion

#region [E-MFG DB connection name: default connection]
//========================================================================================================================
// E-MFG DB connection name: default connection
//========================================================================================================================

// http://127.0.0.1:8000/api/interface_sap_po
Route::get('interface_sap_po', function () {
    $result = DB::select("EXEC interface_sap_po '20190101','20220101','',100");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/interface_sap_po/PO19000483
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
    $result = DB::select("EXEC interface_sap_inv '20190101','20220101', '' ,100");
    return json_encode($result);
});

// http://127.0.0.1:8000/api/interface_sap_inv/PO19000483
Route::get('/interface_sap_inv/{doc_num}', function ($doc_num) {
    $result = DB::select("EXEC interface_sap_inv '20190101','20220101','$doc_num',100");
    return json_encode($result);
});
#endregion

#region [E-MFG DB connection name: sqlsrv_shipping_db]
//========================================================================================================================
// E-MFG DB connection name: sqlsrv_shipping_db
//========================================================================================================================
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
#endregion

#region [EPS DB connection name: sqlsrv_eps_db]
//========================================================================================================================
// EPS DB connection name: sqlsrv_eps_db
//========================================================================================================================
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

Route::get('report_budget_checking', function () {
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC report_budget_checking '20190101','20220101','',100");
    return json_encode($result);
});
// http://127.0.0.1:8000/api/report_budget_checking/ xxxxxxxxx
Route::get('report_budget_checking/{doc_num}', function ($doc_num) {
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC report_budget_checking '20190101','20220101','$doc_num',100");
    return json_encode($result);
});
#endregion


//========================================================================================================================
// SAMPLE CALLING WITH QUERY STRING
//========================================================================================================================
// http://127.0.0.1:8000/api/emfg_shipping_log_ok_obj/doc_num=D30BA017510&start_date=20190101&end_date=20220401&max_record=100
// http://127.0.0.1:8000/api/emfg_shipping_log_ok_obj/doc_num=PO19007289&start_date=20210101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_ok_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ok '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});
//========================================================================
// SAP interface Object
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_po_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('interface_sap_po_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC interface_sap_po '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});

// http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_rec_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('interface_sap_rec_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC interface_sap_rec '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});

// http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_inv_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('interface_sap_inv_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC interface_sap_inv '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});
//========================================================================
// E-MFG Object
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_order_status_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_order_status_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC sqlsrv_shipping_db '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});

// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_ok_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_ok_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC sqlsrv_shipping_db '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});

// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_ng_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_ng_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC sqlsrv_shipping_db '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});

// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_event_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_event_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC sqlsrv_shipping_db '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});

//========================================================================
// EPS Object
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_interface_pr_po_to_planner_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_interface_pr_po_to_planner_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC sqlsrv_eps_db '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

// http://10.100.1.94:8080/wissdemo01/public/api/eps_interface_sap_pr_outstanding_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_interface_sap_pr_outstanding_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC sqlsrv_eps_db '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

// http://10.100.1.94:8080/wissdemo01/public/api/report_budget_checking_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('report_budget_checking_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC sqlsrv_eps_db '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

