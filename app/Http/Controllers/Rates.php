<?php

namespace App\Http\Controllers;
use App\AuditModel;

use Illuminate\Http\Request;

class Rates extends Controller
{
    //
    public function getRates()
    {
        $data = AuditModel::get()->first();
        return response()->json(compact('data'));
    }

    public function getTransactionData($address)
    {
        $URL = 'http://api.etherscan.io/api?module=account&action=txlist&address=' . $address . '&startblock=0&endblock=99999999&sort=desc&apikey=1HUI6UTTVE64IMQYPH85UCWA12JXXM4CEQ';
        $data = file_get_contents($URL);
        $data = json_decode($data, true);
        return response()->json(compact('data'));
    }
}
