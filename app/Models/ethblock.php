<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ethblock extends Model
{
    protected $table='ethblock';
    protected $fillable = ['BlockID','BlockNumber','BLOCKHASH','TXHASH','TXNSTATUS','Nounce','TRANSACTIONINDEX','FROMADDRESS','TOADDRESS','VALUE','TIME','GASPRICE','GAS','INPUT','TOKENRECEIVERADDRESS','NUMBEROFTOKENS'];

}
