<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommodityPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_price_id')->unsigned();
            $table->foreign('type_price_id')->references('id')->on('type_prices');
            $table->integer('commodity_id')->unsigned();
            $table->foreign('commodity_id')->references('id')->on('commodities');
            $table->integer('market_id')->unsigned();
            $table->foreign('market_id')->references('id')->on('markets');
            $table->bigInteger('price');
            $table->bigInteger('gap')->default(0);
            $table->date('date');
            $table->enum('status', ['up', 'down', 'equal'])->nullable();
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
        Schema::dropIfExists('commodity_prices');
    }
}
