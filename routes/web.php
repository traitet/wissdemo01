<?php

// ==========================================================================
// IMPORT
// ==========================================================================
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasicReportApiController;
use App\Http\Controllers\InterfaceSapPoApiController;
use App\Http\Controllers\InterfaceSapRecApiController;
use App\Http\Controllers\InterfaceSapInvApiController;
use App\Http\Controllers\EmfgShippingLogOkApiController;
use App\Http\Controllers\EmfgShippingLogNgApiController;
use App\Http\Controllers\EmfgShippingLogEventApiController;
use App\Http\Controllers\EmfgShippingStatusApiController;
use App\Http\Controllers\EpsBgCheckingApiController;
use App\Http\Controllers\EpsPrOutstandingApiController;
use App\Http\Controllers\EpsPrPoToPlannerApiController;
use App\Http\Controllers\EpsPrErrorApiController;
use App\Http\Controllers\EpsPrProductionErrorApiController;
use App\Http\Controllers\EpsCpApprovePrApiController;
use App\Http\Controllers\EmfgInventoryStockOutErrorApiController;
use App\Http\Controllers\EdrawingCheckPasswordApiController;

// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('basic-report-api','basic-report-api');
Route::post('basic-report-api',[BasicReportApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< SAP >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('interface-sap-po','interface-sap-po');
Route::post('interface-sap-po',[InterfaceSapPoApiController::class,'getData']);

// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('interface-sap-rec','interface-sap-rec');
Route::post('interface-sap-rec',[InterfaceSapRecApiController::class,'getData']);

// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('interface-sap-inv','interface-sap-inv');
Route::post('interface-sap-inv',[InterfaceSapInvApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< E-MFG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('emfg-shipping-log-ok','emfg-shipping-log-ok');
Route::post('emfg-shipping-log-ok',[EmfgShippingLogOkApiController::class,'getData']);

Route::view('emfg-shipping-log-ng','emfg-shipping-log-ng');
Route::post('emfg-shipping-log-ng',[EmfgShippingLogNgApiController::class,'getData']);

Route::view('emfg-shipping-log-event','emfg-shipping-log-event');
Route::post('emfg-shipping-log-event',[EmfgShippingLogEventApiController::class,'getData']);

Route::view('emfg-shipping-status','emfg-shipping-status');
Route::post('emfg-shipping-status',[EmfgShippingStatusApiController::class,'getData']);

Route::view('emfg-inventory-stock-out-error','emfg-inventory-stock-out-error');
Route::post('emfg-inventory-stock-out-error',[EmfgInventoryStockOutErrorApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< EPS >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('eps-pr-outstanding','eps-pr-outstanding');
Route::post('eps-pr-outstanding',[EpsPrOutstandingApiController::class,'getData']);

Route::view('eps-pr-po-planner','eps-pr-po-planner');
Route::post('eps-pr-po-planner',[EpsPrPoToPlannerApiController::class,'getData']);

Route::view('eps-bg-checking','eps-bg-checking');
Route::post('eps-bg-checking',[EpsBgCheckingApiController::class,'getData']);

Route::view('eps-pr-error','eps-pr-error');
Route::post('eps-pr-error',[EpsPrErrorApiController::class,'getData']);

Route::view('eps-pr-production-error','eps-pr-production-error');
Route::post('eps-pr-production-error',[EpsPrProductionErrorApiController::class,'getData']);

Route::view('eps-cp-approve-pr','eps-cp-approve-pr');
Route::post('eps-cp-approve-pr',[EpsCpApprovePrApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< E-Drawing >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('edrawing-check-password','edrawing-check-password');
Route::post('edrawing-check-password',[EdrawingCheckPasswordApiController::class,'getData']);


// ==========================================================================
// ROUTE GET/POST "MAIN"
// ==========================================================================
Route::view('main','main');
Route::post('main',[MainController::class,'getData']);

// ==========================================================================
// ROUTE VIEW
// ==========================================================================
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/menu', function () {
    return view('menu');
});


Route::get('/', function () {
    return view('basic-report');
});

Route::get('/demo', function () {
    return view('demo');
});


Route::get('/basic-report', function () {
    return view('basic-report');
});

Route::get('/basic-report-api', function () {
    return view('basic-report-api');
});

Route::get('/test', function () {
    return view('test');
});


