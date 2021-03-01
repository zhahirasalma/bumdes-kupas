<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengambilanSampahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengambilan_sampah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_users')->nullable();
            $table->unsignedBigInteger('id_warga')->nullable();
            $table->date('waktu_pengambilan')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_warga')->references('id')->on('warga')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengambilan_sampah');
    }
}
