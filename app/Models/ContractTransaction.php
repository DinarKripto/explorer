<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractTransaction extends Model
{
    protected $table='contract_transactions';
    protected $fillable = ['id','blockHash','blockNumber','confirmations','contractAddress','cumulativeGasUsed','from','gas','gasPrice','gasUsed','hash','input','isError','nonce','timeStamp','to','transactionIndex','txreceipt_status','value'];
}
