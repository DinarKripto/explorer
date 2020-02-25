<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit', function (Blueprint $table) {
            $table->increments('id');
            $table->float('weight', 11, 7);
            $table->float('dnc_rate',11, 7);
            $table->float('gold_rate', 11, 7);
            $table->float('btc_rate', 11, 7);
            $table->float('eth_rate', 11, 7);
            $table->float('ddk_rate', 11, 7);
            $table->float('btc_balance', 11, 7);
            $table->float('eth_balance', 11, 7);
            $table->float('ddk_balance', 11, 7);
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
        Schema::dropIfExists('audit');
    }
}
