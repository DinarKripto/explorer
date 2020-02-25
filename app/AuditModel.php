<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditModel extends Model
{
    //
    protected $table = 'audit';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'weight', 'dnc_rate', 'gold_rate', 'btc_rate', 'eth_rate', 'ddk_rate', 'btc_balance', 'eth_balance', 'ddk_balance','dnc_total_supply','dnc_sell_rate','dnc_eth_sell_rate','dnc_btc_sell_rate',
    ];
}
