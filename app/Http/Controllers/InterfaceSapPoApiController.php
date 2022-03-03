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
class InterfaceSapPoApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================

    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_po_obj';

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
            // ======================================================================
            // GET DATA
            // ======================================================================
            $dateStart = str_replace('-','',$req->input('dateStart')??'20220101');
            $dateEnd = str_replace('-','',$req->input('dateEnd')??'20220101');
            $maxRecord = $req->input('maxRecord')??'10';
            $docNum = $req->input('docNum')??'';
            $queryStr = "doc_num=$docNum&start_date=$dateStart&end_date=$dateEnd&max_record=$maxRecord";

            // ======================================================================
            // CALL API
            // ======================================================================
            $url = $this->ENDPOINT . $api ."/". $queryStr;
            $response = Http::get($url);

            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if ($response->status() == 200) {
                $result = json_decode($response->body(), true);
                if(!empty($result)){
                    $keyArray = array_keys($result[0]);
                    return view('interface-sap-po', compact('result', 'keyArray'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            return view('interface-sap-po');
    }
}
