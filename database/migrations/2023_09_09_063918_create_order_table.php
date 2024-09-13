<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice');
            $table->foreignId('costumer_id');
            $table->integer('amount_total');
            $table->integer('shipment_total');
            $table->mediumText('shipment_address');
            $table->string('subdistrict')
                ->nullable();
            $table->string('status');
            $table->string('payment_proof')
                ->nullable();
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
        Schema::dropIfExists('order');
    }
};
