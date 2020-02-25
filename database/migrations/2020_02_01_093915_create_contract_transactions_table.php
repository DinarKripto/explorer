<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('blockHash');
            $table->text('blockNumber');
            $table->text('confirmations');
            $table->text('contractAddress');
            $table->text('cumulativeGasUsed');
            $table->text('from');
            $table->text('gas');
            $table->text('gasPrice');
            $table->text('gasUsed');
            $table->text('hash');
            $table->text('input');
            $table->text('isError');
            $table->text('nonce');
            $table->text('timeStamp');
            $table->text('to');
            $table->text('transactionIndex');
            $table->text('txreceipt_status');
            $table->text('value');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_transactions');
    }
}
