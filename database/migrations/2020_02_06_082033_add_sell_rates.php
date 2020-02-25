<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSellRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audit', function (Blueprint $table) {
            $table->float('dnc_sell_rate', 11, 7);
            $table->float('dnc_eth_sell_rate', 11, 7);
            $table->float('dnc_btc_sell_rate', 11, 7);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audit', function (Blueprint $table) {
            $table->dropColumn(['dnc_sell_rate']);
            $table->dropColumn(['dnc_eth_sell_rate']);
            $table->dropColumn(['dnc_btc_sell_rate']);
        });
    }
}
