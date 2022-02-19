<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;

class MainController extends Controller
{

    private $ENDPOINT = 'http://10.100.1.94/wiss-api';
    //
    // public function index()
    // {

    //     // $client = new Client();
    //     // $response = Http::get('http://10.100.1.94/wiss-api/ErrorLog/Mockup');
    //     $response = Http::get('http://10.100.1.94/wiss-api/EventLog/1S%20SRCTBS1A4046');

    //     if($response->status() == 200){

    //         $result = json_decode($response->body(),true);

    //         $keyArray = array_keys($result[0]);

    //     }else{
    //         $result = 'no result';
    //     }


    //     return view('main.main', compact('result','keyArray'));
    // }

    function getData(Request $req)
    {
        $this->validate($req, [
            'dateStart' => 'date_format:Y-m-d||nullable',
            'dateEnd' => 'date_format:Y-m-d||nullable',
            'pdsNo' => 'string||nullable'
        ]);
        $api = '';
        if (!empty($req->input('dateStart')) || !empty($req->input('dateEnd')) || !empty($req->input('pdsNo'))) {


            $dateStart = $req->input('dateStart');
            $dateEnd = $req->input('dateEnd');
            $pdsNo = $req->input('pdsNo');
            // $reportType[] = $req->input('typeOKNG');
            // $reportType[] = $req->input('typeErrorEvent');
            if (!empty($req->input('typeOKNG'))) {
                foreach ($req->input('typeOKNG') as $value) {
                    $reportType[] = $value;
                }
            }
            if (!empty($req->input('typeErrorEvent'))) {
                foreach ($req->input('typeErrorEvent') as $value) {
                    $reportType[] = $value;
                }
            }

            if (!empty($reportType)) {
                foreach ($reportType as $data) {
                    switch ($data) {
                        case 'OK':
                            $api = '/OkLog';
                            break;
                        case 'NG':
                            $api = '/NgLog';
                            break;
                        case 'Error':
                            $api = '/ErrorLog';
                            break;
                        case 'Event':
                            $api = '/EventLog';
                            break;
                    }
                }
            }

            // $response = Http::get('http://10.100.1.94/wiss-api/NgLog/:pdsNum', [
            //     'pdsNum' => '1S SA11AS1R9777'
            // ]);
            $url = $this->ENDPOINT . $api ."/". $pdsNo;
            // echo $url;
            $response = Http::get($url);
            // $response = Http::get($this->ENDPOINT . '/EventLog/1S%20SRCTBS1A4046');
            if ($response->status() == 200) {

                $result = json_decode($response->body(), true);
                if(!empty($result)){
                    $keyArray = array_keys($result[0]);
                }else{
                    //need to return no data msg
                    $keyArray = [];

                }

            }
        }

        return view('main', compact('result', 'keyArray'));
    }
}
