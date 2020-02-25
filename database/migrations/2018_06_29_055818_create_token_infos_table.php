<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('ContractAddress');
            $table->text('name');
            $table->text('symbol');
            $table->text('TotalSupply');
            $table->text('Decimal');
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
        Schema::dropIfExists('token_infos');
    }
}
