<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenInfo extends Model
{
    protected $table='token_infos';
    protected $fillable=['id','ContractAddress','name','symbol','TotalSupply','Decimal','owner','transfersCount','lastUpdated','issuancesCount','holdersCount','ethTransfersCount','countOps'];
}
