<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeInBitcoinRateAudit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audit', function (Blueprint $table) {
            $table->dropColumn(['btc_rate']);
        });
        Schema::table('audit', function (Blueprint $table) {
            $table->float('btc_rate', 12, 7)->after('gold_rate');
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
            $table->dropColumn(['btc_rate'])->after('gold_rate');
        });
        Schema::table('audit', function (Blueprint $table) {
            $table->float('btc_rate', 11, 7);
        });
    }
}
