<?php

namespace App\Http\Controllers;

// ==========================================================================
// IMPORT
// ==========================================================================
use Facade\FlareClient\View;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;

// ==========================================================================
// CLASS DECLARATION
// ==========================================================================
class EmfgShippingLogEventApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_ng';

// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            'dateStart' => 'date_format:Y-m-d||nullable',
            'dateEnd' => 'date_format:Y-m-d||nullable',
            'docNum' => 'string||nullable'
        ]);
        // ==========================================================================
        // API NAME
        // ==========================================================================
        $api = '';


        // ==========================================================================
        // CHECK INPUT IF NOT EMPTY
        // ==========================================================================
             $docNum = $req->input('docNum')??'';
            // ======================================================================
            // GET DATA
            // ======================================================================
            // $dateStart = $req->input('dateStart');
            // $dateEnd = $req->input('dateEnd');
            // ======================================================================
            // CALL API
            // ======================================================================
            $url = $this->ENDPOINT . $api ."/". $docNum;
            $response = Http::get($url);
            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if ($response->status() == 200) {
                $result = json_decode($response->body(), true);
                if(!empty($result)){
                    $keyArray = array_keys($result[0]);
                    return view('emfg-shipping-log-event', compact('result', 'keyArray'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            return view('emfg-shipping-log-event');
    }
}
