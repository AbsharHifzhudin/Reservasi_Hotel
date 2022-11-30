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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_kamar');
            $table->string('metode_pembayaran');
            $table->timestamp('waktu_pembayaran');
            $table->integer('total_uang_diterima');
            $table->integer('harga_total');
            $table->integer('kembalian');
            $table->string('konfirmasi_pembayaran');
            $table->rememberToken();
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
        Schema::dropIfExists('pembayarans');
    }
};
