<?php

namespace App\Http\Controllers;


use Request;
use DB;
use App\Models\ethblock;
use App\Models\TokenInfo;
use App\Models\ContractTransaction;

use Illuminate\Support\Facades\Session;
use DateTime;
use Carbon;

class DashboardController extends Controller
{


    public function index()
    {
        $maxBlockNumber = ContractTransaction::max('blockNumber');
        $TokenTxn = ethblock::where('NUMBEROFTOKENS', '!=', 'undefined')->get();
        $TokenTxn_count = ethblock::where('NUMBEROFTOKENS', '!=', 'undefined')->where('TXNSTATUS', '=', 'true')->count();
        $UnsuccessTokenTxn_count = ContractTransaction::where('txreceipt_status', '=', '0')->count();
        $ContractTxn_count = ContractTransaction::count();
        $Contract_transactions = ContractTransaction::orderBy('blockNumber', 'desc')->take(8)->get();
        $Token_transactions = ethblock::where('NUMBEROFTOKENS', '!=', 'undefined')->orderBy('TIME', 'desc')->take(12)->get();
        $Account_count = $this->GetTopAccountHolder();
        $Account_count = sizeof($Account_count);
        $mintCount = ContractTransaction::where('method','null')->orWhere('method','MinterFunction')->orderBy('blockNumber', 'desc')->count();
        $burnCount = ContractTransaction::where('method','burn')->orderBy('blockNumber', 'desc')->count();
        $mint = ContractTransaction::where('method','null')->orWhere('method','MinterFunction')->orderBy('blockNumber', 'desc')->take(10)->get();
        $burn = ContractTransaction::where('method','burn')->orderBy('blockNumber', 'desc')->take(10)->get();
        $changeRate = ContractTransaction::where('method','ChangeRate')->orderBy('blockNumber', 'desc')->take(10)->get();
  
        session(['ContractTxn_count' => $ContractTxn_count, 'TokenTxn_count' => $TokenTxn_count]);
        return view('main', compact('maxBlockNumber','Account_count', 'TokenTxn_count', 'UnsuccessTokenTxn_count', 'ContractTxn_count', 'Contract_transactions', 'Token_transactions', 'mint','burn', 'changeRate','mintCount','burnCount'));

    }
    
    public function getAllTransactions(){
        $data = ContractTransaction::orderBy('blockNumber', 'desc')->take(100)->get();
        return response()->json(compact('data'));
    }

    public function viewMore($name){
        $data = ContractTransaction::orderBy('blockNumber', 'desc')->take(1000)->get();
        return response()->json(compact('data','name'));
    }

    public function viewMoreContract(Request $request, $name)
    {
        $data = "";
        
        if(strcmp(strtoupper($name), 'MINT') == 0)
        {
            $data = ContractTransaction::where('method','null')->orWhere('method','MinterFunction')->orderBy('blockNumber', 'desc')->get();
        }
        else if(strcmp(strtoupper($name), 'BURN') == 0)
        {
            $data = ContractTransaction::where('method','burn')->orderBy('blockNumber', 'desc')->get();
        }
        else if(strcmp(strtoupper($name), 'CHANGERATE') == 0)
        {
            $data = ContractTransaction::where('method','ChangeRate')->orderBy('blockNumber', 'desc')->get();
        }
        return view('viewMoreContract', compact('data','name'));
    }
    public function viewMoreToken(){
        $Token_transactions = ethblock::where('NUMBEROFTOKENS', '!=', 'undefined')->orderBy('TIME', 'desc')->get();

        return view('viewMoreToken', compact('Token_transactions'));
    }


    public function TransactionHome()
    {
        $address = \Config::get('contract.values.address');
        $Token_info  = tokenInfo::Select('*')->first();
        $Contract_transactions = ContractTransaction::orderBy('blockNumber', 'desc')->paginate(15, ['*'], 'contract');
        $Token_transactions = ethblock::where('NUMBEROFTOKENS', '!=', 'undefined')->where('TXNSTATUS', '=', 'true')->orderBy('time', 'desc')->paginate(15, ['*'], 'token');
 
        return view('home', compact('Token_info', 'Contract_transactions', 'Token_transactions'));
    }


    public function TokenTransactions()
    {
        $Token_info = tokenInfo::Select('*')->first();
        $Token_transactions = ethblock::where('NUMBEROFTOKENS', '!=', 'undefined')->where('TXNSTATUS', '=', 'true')->orderBy('BlockID', 'desc')->paginate(15, ['*'], 'token');
        return view('TokenTxn', compact('Token_info', 'Token_transactions'));
    }


    public function goldRedeem(){
        return view('goldredeem', compact('goldRedeem', 'goldRedeem'));
    }


    public function SingleTransaction()
    {
        $Token_info = tokenInfo::Select('*')->first();
        return view('transaction', compact('Token_info'));
    }


    public function SingleTokenTransaction(Request $request)
    {
        $uri = Request::path();
        $hash = strrchr($uri, "/");
        $hash = ltrim($hash, '/');
        $Token_info = tokenInfo::Select('*')->first();
        $Txn_detail = ethblock::Select('*')->where('TXHASH', $hash)->where('NUMBEROFTOKENS', '!=', 'undefined')->first();
        return view('transaction', compact('Token_info', 'Txn_detail'));
    }


    public function SingleContractTransaction(Request $request)
    {
        $uri = Request::path();
        $hash = strrchr($uri, "/");
        $hash = ltrim($hash, '/');
        $Token_info = tokenInfo::Select('*')->first();
        $Txn_detail = ContractTransaction::Select('*')->where('hash', $hash)->first();

        return view('ContractTransaction', compact('Token_info', 'Txn_detail'));
    }


    public function SearchedHashTransaction(Request $request)
    {

        $Token_info = tokenInfo::Select('*')->first();
        $uri = Request::path();
        $hash = strrchr($uri, "/");
        $hash = ltrim($hash, '/');
        $Txn_detail = ethblock::Select('*')->where('TXHASH', $hash)->first();
        $Txn_ContractTransaction = ContractTransaction::Select('*')->where('hash', $hash)->first();

        if($Txn_ContractTransaction){
            $Txn_detail = $Txn_ContractTransaction;
            return view('ContractTransaction', compact('Token_info', 'Txn_detail'));
        }
        else if ($Txn_detail) {
            return view('transaction', compact('Token_info', 'Txn_detail'));
        } else {
            return view('NotExistHash', compact('Token_info'));
        }
    }


    public function SearchedBlockTransaction(Request $request)
    {
        $Token_info = tokenInfo::Select('*')->first();
        $uri = Request::path();
        $block = strrchr($uri, "/");
        $block = ltrim($block, '/');
        $Block_detail = ethblock::Select('*')->where('BlockNumber', $block)->get();
        session(['Block_detail' => $Block_detail]);

        if (sizeof($Block_detail) == 0) {
            return view('NotExistBlock', compact('Token_info'));
        } else {
            return view('BlockTransaction', compact('Token_info', 'Block_detail'));
        }
    }

    public function SearchedAccountTransaction(Request $request)
    {
        $Token_info = tokenInfo::Select('*')->first();
        $uri = Request::path();
        $Account = strrchr($uri, "/");
        $Account = ltrim($Account, '/');
        $Account_detail = ethblock::
        Select('*')->where('ToToken', $Account)
        
        ->orwhere('FromToken', $Account)->get();
        $AccountTxnCount = DB::table("ethblock")
            ->select('ToToken', DB::raw('COUNT(NUMBEROFTOKENS) as TxnCount,SUM(NUMBEROFTOKENS) as TokenSum'))
            ->Where('ToToken', '=', $Account)
            ->where('ToToken','!=','0x0000000000000000000000000000000000000000')
            ->Where('NUMBEROFTOKENS', '!=', 'undefined')
            ->Where('TXNSTATUS', '=', 'true')
            ->orderBy("ToToken", 'DESC')
            ->groupBy(DB::raw("ToToken"))
            ->paginate(15);

        $AccountSendTxnCount = DB::table("ethblock")
            ->select('FromToken', DB::raw('COUNT(NUMBEROFTOKENS) as TxnCount,SUM(NUMBEROFTOKENS) as TokenSum'))
            ->Where('FromToken', '=', $Account)
            ->where('ToToken','!=','0x0000000000000000000000000000000000000000')
            ->where('FromToken','!=','0x0000000000000000000000000000000000000000')
            ->Where('NUMBEROFTOKENS', '!=', 'undefined')
            ->Where('TXNSTATUS', '=', 'true')
            ->orderBy("FromToken",'DESC')
            ->groupBy(DB::raw("FromToken"))
            ->get();

        //Calculating Token Sum and Txn Count, & send to view
        if (sizeof($Account_detail) == 0) {
            return view('NotExistAccount', compact('Token_info'));
        } else {
            foreach ($AccountTxnCount as $key => $value) {
                   if (sizeof($AccountSendTxnCount) != 0) {
                     foreach ($AccountSendTxnCount as $keys => $values) {
                        if ($value->ToToken == $values->FromToken) {
                            $FinalTxnCount = $value->TxnCount + $values->TxnCount;
                            $FinalTxnSum = bcsub($value->TokenSum,$values->TokenSum,4);
                            $value->TxnCount = $FinalTxnCount;
                            $value->TokenSum = $FinalTxnSum;
                            return view('accountTransaction', compact('Token_info', 'Account_detail', 'AccountTxnCount', 'FinalTxnCount', 'FinalTxnSum', 'Account'));
                            break;
                        }
                    }
                } else {

                    $FinalTxnCount = $value->TxnCount;
                    $FinalTxnSum = $value->TokenSum;
                    return view('accountTransaction', compact('Token_info', 'Account_detail', 'AccountTxnCount', 'FinalTxnCount', 'FinalTxnSum', 'Account'));
                }
            }
        }
    }

    private function getTokenInfo()
    {
        $Token_info = tokenInfo::Select('*')->first();
        return $Token_info;
    }
    private function GetTopAccountHolder()
    {
        
        $address = \Config::get('contract.values.address');
        $api_key = \Config::get('contract.values.ethplorerApiKey');
        
        $Account = file_get_contents('https://api.ethplorer.io/getTopTokenHolders/'. $address .'?apiKey='. $api_key);
        $Account = json_decode($Account , true);
        return $Account["holders"];
    }
    public function AccountTransaction(){

        $Token_info  = $this->getTokenInfo();      
        $Account = $this->GetTopAccountHolder();
        return view('accountNavbar', compact('Token_info', 'Account'));

    }

    public function Block(Request $request)
    {
        $Token_info = tokenInfo::Select('*')->first();
        $Block_detail = Session::get('Block_detail');
        return view('block', compact('Token_info', 'Block_detail'));
    }

    public static function DisplayPrice($args) 
    {
        $len = strlen($args);
        $len = 19 - $len;
        $num = $args/1000000000000000000;
        $afterDecimal = strspn($num, "0", strpos($num, ".")+1);
        if($len<4){
            $len = 3;
        }
        
        return number_format($num,$len,'.',',');
    }

    public static function TimeElapseString($datetime, $full = false) 
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}


