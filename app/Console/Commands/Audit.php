<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use App\AuditModel;
use App\Models\TokenInfo;
use App\Models\ContractTransaction;

class Audit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audit:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update audit data after every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->UpdateAudit();
    }

    
    private function UpdateAudit()
    {
         
        $address = \Config::get('contract.values.address');
        $api_key = \Config::get('contract.values.ethplorerApiKey');
         
        $btc_address = '1EU4N4U4MGFxDt62iSYBVuZ6v1yTwRCp7G';
        $eth_address ='0x8EbCE038Dc6851655e230A6D2d088c70d584A92A';
        $eth_address1 ='0x4eb407685cc8600386A15dF4B442A265715Beb16';
        
        $ddk_address = '14071058380470127236';

        $minting = env('MINTING_URL','http://mint.dinarkripto.com');

        $URL = $minting . '/api/goldreserve';
        
        $data = file_get_contents($URL);
        $data = json_decode($data, true);

        $weight = 0;

        foreach($data["data"] as $value){
            $w = floatval($value["weight"]);
            $weight = $weight + $w;
        }

        $dnc_rate = file_get_contents('https://www.harimaumintgold.my/price-active-dnc.asp?q=1&b=usd');
        $dnc_rate = json_decode($dnc_rate, true);
        
        $dnc_sell_rate = $dnc_rate["sell"];
        $dnc_sell_rate = str_replace(",","",$dnc_sell_rate);

        $dnc_rate = $dnc_rate["buy"];
        $dnc_rate = str_replace(",","",$dnc_rate);

        
        $dnc_eth_sell_rate = file_get_contents('https://www.harimaumintgold.my/price-active-dnc.asp?q=1&b=eth');
        $dnc_eth_sell_rate = json_decode($dnc_eth_sell_rate, true);
        $dnc_eth_sell_rate = $dnc_eth_sell_rate["sell"];

        $dnc_eth_sell_rate = str_replace(",","",$dnc_eth_sell_rate);

        $gold_rate = file_get_contents('https://www.harimaumintgold.my/price-active-dnc.asp?q=1&b=usd&type=gram');
        $gold_rate = json_decode($gold_rate, true);
        $gold_rate = $gold_rate["buy"];
        $gold_rate = str_replace(",","",$gold_rate);

        
        $btc_rate = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=ETH,USD');
        $btc_rate = json_decode($btc_rate, true);
        $btc_rate = $btc_rate["USD"];

        $dnc_btc_sell_rate = $dnc_sell_rate/$btc_rate;


        $eth_rate = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=ETH,USD');
        $eth_rate = json_decode($eth_rate, true);
        $eth_rate = $eth_rate["USD"];

        $ddk_rate = file_get_contents('https://api.coinranking.com/v1/public/coin/14288');
        $ddk_rate = json_decode($ddk_rate, true);
        $ddk_rate = $ddk_rate["data"]["coin"]["price"];
        
        $btc_balance = file_get_contents('https://blockchain.info/de/q/addressbalance/' . $btc_address);
        $btc_balance = json_decode($btc_balance, true);
        $btc_balance = $btc_balance/100000000;

        $URL = $minting . '/api/getBTCAllocatedAddresses';
        
        $data = file_get_contents($URL);
        $data = json_decode($data, true);

        foreach($data["data"] as $value){
            $address = $value["address"];
            $address_balance = file_get_contents('https://blockchain.info/de/q/addressbalance/' . $address);
            $address_balance = json_decode($address_balance, true);
            $address_balance = $address_balance/100000000;
            $btc_balance = $btc_balance + $address_balance;
        }


        $eth_balance = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address=' . $eth_address . '&tag=latest&apikey=1HUI6UTTVE64IMQYPH85UCWA12JXXM4CEQ');
        $eth_balance = json_decode($eth_balance, true);
        $eth_balance = $eth_balance["result"];

        $eth_balance1 = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address=' . $eth_address1 . '&tag=latest&apikey=1HUI6UTTVE64IMQYPH85UCWA12JXXM4CEQ');
        $eth_balance1 = json_decode($eth_balance1, true);
        $eth_balance1 = $eth_balance1["result"];
        
        $eth_balance = $eth_balance + $eth_balance1;
        
        $ddk_balance = file_get_contents('http://explorer.dinarkripto.com:7070/api/accounts/'. $ddk_address .'/balance');
        $ddk_balance = json_decode($ddk_balance, true);
        $ddk_balance = floatval($ddk_balance["data"])/100000000;

        $dnc_total_supply = file_get_contents('https://api.etherscan.io/api?module=stats&action=tokensupply&contractaddress=0xa72e909fa123b3d0ed1f8b4607440ff1f2c87030&apikey=1HUI6UTTVE64IMQYPH85UCWA12JXXM4CEQ');
        $dnc_total_supply = json_decode($dnc_total_supply , true);
        $dnc_total_supply = floatval($dnc_total_supply["result"])/1000000000000000000;
        
        $tokenInfo = TokenInfo::firstOrNew(array('id' => 1));

        $tokenInfo->TotalSupply = $dnc_total_supply;

        $tokenInfo->save();        
        $audit = AuditModel::firstOrNew(array('id' => 1));
        $audit->weight = $weight;
        $audit->dnc_rate = $dnc_rate;
        $audit->gold_rate = $gold_rate;
        $audit->btc_rate = $btc_rate;
        $audit->eth_rate = $eth_rate;
        $audit->ddk_rate = $ddk_rate;
        $audit->btc_balance = $btc_balance;
        $audit->eth_balance = $eth_balance/1000000000000000000;
        $audit->ddk_balance = $ddk_balance;
        $audit->dnc_total_supply = $dnc_total_supply;

        $audit->dnc_sell_rate = $dnc_sell_rate;
        $audit->dnc_eth_sell_rate =$dnc_eth_sell_rate;
        $audit->dnc_btc_sell_rate = $dnc_btc_sell_rate;

        $audit->save();
    }
}
