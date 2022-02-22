<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WissApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $json = '{"id" :1, "name" : "Wiss API"},{"id" :2, "name" : "Wiss API2"}';
        return $json;

        // return response()->json(['rowid' => 18015965, 'functionName' => 'Download_Plan']);
    }

    public function show($id)
    {

        if ($id == 'a') {$json = '{"id" :1, "name" : "Wiss API"},{"id" :2, "name" : $id}';}
        if ($id == 'b') {$json = '{"id" :1, "name" : "Wiss API"},{"id" :2, "name" : "b"}';}
        if ($id == 'c') {$json = '{"id" :1, "name" : "Wiss API"},{"id" :2, "name" : "c"}';}

        return $json;

        // return response()->json(['rowid' => 18015965, 'functionName' => 'Download_Plan']);
    }
}
