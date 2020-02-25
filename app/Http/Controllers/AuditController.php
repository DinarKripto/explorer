<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuditModel;

class AuditController extends Controller
{
    public function index()
    {
        return view('audit', $this->getAuditData());
    }
    public function getAuditData(){
        
        $audit = AuditModel::get()->first();
        
        $weight = $audit->weight;
        $dnc_rate = $audit->dnc_rate;
        $gold_rate = $audit->gold_rate;
        $btc_rate = $audit->btc_rate;
        $eth_rate = $audit->eth_rate;
        $ddk_rate = $audit->ddk_rate;
        $btc_balance = $audit->btc_balance;
        $eth_balance = $audit->eth_balance;
        $ddk_balance = $audit->ddk_balance;
        $dnc_total_supply = $audit->dnc_total_supply;

        $gold_usd = $weight * $gold_rate;
        $btc_usd = $btc_rate * $btc_balance;
        $eth_usd = $eth_rate * $eth_balance;
        $ddk_usd = $ddk_rate * $ddk_balance;

        $total_usd = $gold_usd + $btc_usd + $eth_usd + $ddk_usd;
        $market_cap = $dnc_total_supply * $gold_rate;
        

        
        $gold_percent = number_format($gold_usd/$market_cap*100,2,'.',',');
        $btc_percent = number_format($btc_usd/$market_cap*100,2,'.',',');
        $eth_percent = number_format($eth_usd/$market_cap*100,2,'.',',');
        $ddk_percent = number_format($ddk_usd/$market_cap*100,2,'.',',');
        
       
        $chart = array(
            array('currency' => 'Physical Gold','values' => $gold_percent),
            array('currency' => 'BTC','values' => $btc_percent),
            array('currency' => 'ETH','values' => $eth_percent),
            array('currency' => 'DDK','values' => $ddk_percent)
        );

        $grid = array(
            array('asset' => 'Physical Gold','portfolio' => $gold_percent, 'balance' => $weight . ' Gram', 'btc' => number_format($gold_usd/$btc_rate,8,'.',','), 'usd' => number_format($gold_usd,2,'.',',') ),
            array('asset' => 'Bitcoin','portfolio' => $btc_percent, 'balance' => number_format($btc_balance,8,'.',',') . ' BTC', 'btc' => number_format($btc_balance,8,'.',','), 'usd' =>  number_format($btc_usd,2,'.',',') ),
            array('asset' => 'Etherum','portfolio' => $eth_percent, 'balance' => number_format($eth_balance,4,'.',',') . ' ETH', 'btc' => number_format($eth_usd/$btc_rate,8,'.',','), 'usd' => number_format($eth_usd,2,'.',',') ),
            array('asset' => 'DDKoin','portfolio' => $ddk_percent, 'balance' => number_format($ddk_balance,4,'.',',') . ' DDK', 'btc' => number_format($ddk_usd/$btc_rate,8,'.',','), 'usd' => number_format($ddk_usd,2,'.',','))
        );
        
        $circulation_supply = number_format($dnc_total_supply,3,'.',',');
        $market_cap = number_format(floatval( $market_cap),2);

        return compact('chart','grid','circulation_supply', 'market_cap');
    }
}
