<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiBankSampahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_bank_sampah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_bank_sampah')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->string('keterangan');
            $table->unsignedBigInteger('id_users')->nullable();
            $table->unsignedBigInteger('id_konversi')->nullable();
            $table->string('berat');
            $table->integer('harga_total');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_bank_sampah')->references('id')->on('bank_sampah')->onDelete('cascade');
            $table->foreign('id_konversi')->references('id')->on('konversi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_bank_sampah');
    }
}
