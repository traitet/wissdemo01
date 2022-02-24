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
class EmfgShippingLogOkApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    // private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/shipping_log_ok_obj';
    private $ENDPOINT =      'http://127.0.0.1:8000/wissdemo01/public/api/emfg_shipping_log_ok_obj';

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
            $dateStart = $req->input('dateStart')??'19000101';
            $dateEnd = $req->input('dateEnd')??'20300101';
            $maxRecord = 100;

            // ======================================================================
            // CALL API
            // ======================================================================
            $queryStr = "doc_num=$docNum&start_date=$dateStart&end_date=$dateEnd&max_record=$maxRecord";
            error_log("*************************************************************".$dateStart.$dateEnd.$docNum);
            error_log($queryStr);
            $url = $this->ENDPOINT . $api ."/". $queryStr;
            error_log($url);
             // $url = $this->ENDPOINT . $api ."/". $docNum;
            $response = Http::get($url);
            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if ($response->status() == 200) {
                $result = json_decode($response->body(), true);
                if(!empty($result)){
                    $keyArray = array_keys($result[0]);
                    return view('shipping-log-ok', compact('result', 'keyArray'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            return view('shipping-log-ok');
    }
}
