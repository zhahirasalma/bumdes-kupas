<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankSampahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_sampah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_telp');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('dukuh');
            $table->string('RT');
            $table->string('RW');
            $table->string('detail_alamat');
            $table->unsignedBigInteger('id_users')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_sampah');
    }
}
