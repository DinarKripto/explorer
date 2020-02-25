<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TokenInfo;

class TokenInfoC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the token info after every minute';

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
        
        $address = \Config::get('contract.values.address');
        $api_key = \Config::get('contract.values.ethplorerApiKey');
    
        $token_info_new  = file_get_contents('https://api.ethplorer.io/getTokenInfo/'. $address .'?apiKey='. $api_key);
        $token_info_new  = json_decode($token_info_new , true);
        
        $dnc_total_supply = DB::select(DB::raw("SELECT SUM(CONVERT(NUMBEROFTOKENS,UNSIGNED INTEGER)) as totalSupply FROM `ethblock` WHERE 1"));
        $dnc_total_supply = $dnc_total_supply[0]->totalSupply;
        
        $tokenInfo = TokenInfo::firstOrNew(array('id' => 1));
        $tokenInfo->ContractAddress = $token_info_new["address"];
        $tokenInfo->name = $token_info_new["name"];
        $tokenInfo->symbol = $token_info_new["symbol"];
        $tokenInfo->TotalSupply = $dnc_total_supply;
        $tokenInfo->Decimal = $token_info_new["decimals"];
        $tokenInfo->owner = $token_info_new["owner"];
        $tokenInfo->transfersCount = $token_info_new["transfersCount"];
        $tokenInfo->lastUpdated = $token_info_new["lastUpdated"];
        $tokenInfo->issuancesCount = $token_info_new["issuancesCount"];
        $tokenInfo->holdersCount = $token_info_new["holdersCount"];
        $tokenInfo->ethTransfersCount = $token_info_new["ethTransfersCount"];
        $tokenInfo->countOps = $token_info_new["countOps"];
        
        $tokenInfo->save();
    }
}
