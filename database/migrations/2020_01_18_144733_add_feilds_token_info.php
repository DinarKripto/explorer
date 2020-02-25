<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeildsTokenInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('token_infos', function (Blueprint $table) {
            $table->string('owner');
            $table->string('transfersCount');
            $table->string('lastUpdated');
            $table->string('issuancesCount');
            $table->string('holdersCount');
            $table->string('ethTransfersCount');
            $table->string('countOps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('token_infos', function (Blueprint $table) {
            $table->dropColumn('owner');
            $table->dropColumn('transfersCount');
            $table->dropColumn('lastUpdated');
            $table->dropColumn('issuancesCount');
            $table->dropColumn('holdersCount');
            $table->dropColumn('ethTransfersCount');
            $table->dropColumn('countOps');
        });
    }
}
