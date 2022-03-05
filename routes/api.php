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


// // =========================================================================================================================
// // 1) CALL API TO SQL STORE PROCEDURE (SAMPLE CODE)
// // =========================================================================================================================
// // http://127.0.0.1:8000/api/sp1
// Route::get('sp1', function () {
//     $result = DB::select("EXEC interface_sap_po '20190101','20220101','',100");
//     return json_encode($result);
// });



//========================================================================
// 1) interface_sap_po_obj  (DEFAULT, SIAM_EPSINFDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_po_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
// http://127.0.0.1:8000/api/interface_sap_po_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('interface_sap_po_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC interface_sap_po '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 2.interface_sap_rec (DEFAULT, SIAM_EPSINFDB)
//========================================================================
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

//========================================================================
// 3.interface_sap_inv (DEFAULT, SIAM_EPSINFDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_inv_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('interface_sap_inv_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::select("EXEC interface_sap_inv '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 4.emfg_shipping_log_ok (sqlsrv_shipping_db,SIAM_EPSINFDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_ok_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_ok_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ok '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 5) E-MFG emfg_shipping_log_ng (sqlsrv_shipping_db, SIAM_SHIPPINGDB )
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_ng_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_ng_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ng '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});


//========================================================================
// 6.emfg_shipping_log_event (sqlsrv_shipping_db, SIAM_SHIPPINGDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_event_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_event_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_event '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 7.eps_interface_pr_po_to_planner (sqlsrv_eps_db, SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_interface_pr_po_to_planner_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_interface_pr_po_to_planner_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC eps_interface_pr_po_to_planner '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 8.eps_interface_pr_po_to_planner (sqlsrv_eps_db, SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_interface_sap_pr_outstanding_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_interface_sap_pr_outstanding_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC eps_interface_sap_pr_outstanding '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 9.report_budget_checking_obj (sqlsrv_eps_db,SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/report_budget_checking_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100/doc_type=1
Route::get('report_budget_checking_obj/{obj}/{search}', function ($obj,$search) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    parse_str($search,$myArraySearch);
    $doc_type = $myArraySearch['doc_type'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC report_budget_checking '$start_date','$end_date','$doc_num',$max_record,'$doc_type'");
    return json_encode($result);
});

//========================================================================
// 10.emfg_shipping_order_status_obj (sqlsrv_shipping_db,SIAM_SHIPPINGDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_order_status_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_order_status_obj/doc_num=&start_date=20220201&end_date=20220302&max_record=10
Route::get('emfg_shipping_order_status_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_order_status '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});


//========================================================================
// 11.edrawing_check_password (sqlsrv_ags_j614_db,AGS_J614_J614)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/edrawing_check_password_obj/doc_num=aunchulee_ph&start_date=20190101&end_date=20220225&max_record=100
Route::get('edrawing_check_password_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_ags_j614_db')->select("EXEC wiss_sa_edrawing_authentication '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});


//========================================================================
// 12.eps_pr_issue_error_report (sqlsrv_eps_db,SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_pr_issue_error_report_obj/doc_num=PR22&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_pr_issue_error_report_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_pr_issue_error '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 13.wiss_sa_eps_pr_productionid_error (sqlsrv_eps_db,SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_pr_productionid_error_report_obj/doc_num=PO22&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_pr_productionid_error_report_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_pr_productionid_error '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 14. emfg_inventory_stock_out_error_obj (sqlsrv_siam_arisa_p01_db,SIAM_ARISA_P01)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_event_obj/doc_num=T412&start_date=20190101&end_date=20220225&max_record=100
// doc_num is PARTCODE
Route::get('emfg_inventory_stock_out_error_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_siam_arisa_p01_db')->select("EXEC wiss_sa_emfg_inventory_stock_out_error '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});


//========================================================================
// 15.eps_pr_for_cp_report (sqlsrv_eps_db,SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_interface_pr_po_to_planner_obj/doc_num=PR22&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_pr_for_cp_report_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_pr_for_cp '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

