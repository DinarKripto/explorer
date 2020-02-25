<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoldReserveController extends Controller
{
    public function Index(Request $request){
        $s = $request->get('s');
        $s = str_replace(" ","%20",$s);
        $minting = env('MINTING_URL','http://mint.dinarkripto.com');
        $URL = $minting . '/api/goldreserve?s=' . $s;
        $data = file_get_contents($URL);
        $data = json_decode($data, true);
        return view('goldreserve', compact('data','minting'));
    }
}
