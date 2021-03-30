<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NIK');
            $table->unsignedBigInteger('id_users')->nullable();
            $table->unsignedBigInteger('id_kategori_sampah')->nullable();
            $table->unsignedBigInteger('id_kota')->nullable();
            $table->unsignedBigInteger('id_kecamatan')->nullable();
            $table->unsignedBigInteger('id_desa')->nullable();
            $table->string('no_telp');
            $table->string('dukuh');
            $table->string('detail_alamat');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('id_kategori_sampah')->references('id')->on('kategori_sampah')->onDelete('cascade');
            $table->foreign('id_kota')->references('id')->on('kota')->onDelete('cascade');
            $table->foreign('id_kecamatan')->references('id')->on('kecamatan')->onDelete('cascade'); 
            $table->foreign('id_desa')->references('id')->on('desa')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warga');
    }
}
