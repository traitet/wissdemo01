<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;

class WissApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
         //curl http://127.0.0.1:8000/api/wiss-apis
        $result = DB::select('select * from TMIFIO');
        return json_encode($result);
    }

    public function show($id)
    {
        if ($id == 'a') {$result = DB::select('select TOP 10 * from TMIFIO');}      //curl http://127.0.0.1:8000/api/wiss-apis/a
        if ($id == 'b') {$result = DB::select('select TOP 10 * from TMIFMAT');}     //curl http://127.0.0.1:8000/api/wiss-apis/b
        if ($id == 'c') {$result = DB::select('select TOP 10 * from TMIFVEN');}      //curl http://127.0.0.1:8000/api/wiss-apis/c
        return json_encode($result);
    }
}
