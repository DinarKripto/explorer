<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDecodeInputColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_transactions', function (Blueprint $table) {
            $table->text('method');
            $table->text('decodeInput'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_transactions', function (Blueprint $table) {
            $table->dropColumn(['method']);
            $table->dropColumn(['decodeInput']);
            
        });
    }
}
