<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEthblockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ethblock', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('BlockID');
            $table->integer('BlockNumber');
            $table->text('BLOCKHASH');
            $table->text('TXHASH');
            $table->text('TXNSTATUS');
            $table->text('Nounce');
            $table->text('TRANSACTIONINDEX');
            $table->text('FROMADDRESS');
            $table->text('TOADDRESS');
            $table->text('VALUE');
            $table->text('TIME');
            $table->text('GASPRICE');
            $table->text('GAS');
            $table->text('INPUT');
            $table->text('FromToken');
            $table->text('ToToken');
            $table->text('TOKENRECEIVERADDRESS');
            $table->text('NUMBEROFTOKENS');
            $table->text('METHOD');
            $table->text('DECODEINPUT');
            $table->text('updated_at time');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ethblock');
    }
}
