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
            $table->unsignedBigInteger('id_alamat')->nullable();
            $table->string('no_telp');
            $table->string('dukuh');
            $table->string('detail_alamat');
            $table->string('lokasi');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('id_kategori_sampah')->references('id')->on('kategori_sampah')->onDelete('cascade');
            $table->foreign('id_alamat')->references('id')->on('alamat')->onDelete('cascade'); 
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
