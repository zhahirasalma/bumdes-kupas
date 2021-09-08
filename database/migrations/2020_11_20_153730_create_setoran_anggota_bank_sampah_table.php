<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetoranAnggotaBankSampahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setoran_anggota_bank_sampah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->date('tanggal_transaksi')->nullable();
            $table->unsignedBigInteger('id_bank_sampah')->nullable();
            $table->unsignedBigInteger('id_konversi')->nullable();
            $table->string('berat');
            $table->integer('harga_total');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('setoran_anggota_bank_sampah');
    }
}
