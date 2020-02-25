<?php

use Illuminate\Database\Seeder;
use App\Models\TokenInfo;

class TokenInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tokenInfo = TokenInfo::firstOrNew(array('id' => 1));
        // TokenInfo::create([
            $tokenInfo->ContractAddress = '0xa72e909fa123b3d0ed1f8b4607440ff1f2c87030';
            $tokenInfo->name = 'DinarCoin';
            $tokenInfo->symbol='DNC';
            $tokenInfo->TotalSupply='0';
            $tokenInfo->Decimal = '18';
            $tokenInfo->owner = '0x4eb407685cc8600386a15df4b442a265715beb16';
            $tokenInfo->transfersCount ='0';
            $tokenInfo->lastUpdated = '1579179224';
            $tokenInfo->issuancesCount = '0';
            $tokenInfo->holdersCount = '0';
            $tokenInfo->ethTransfersCount = '0';
            $tokenInfo->countOps = '0';  
            
            $tokenInfo->save();

    }
}
