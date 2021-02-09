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
            $table->unsignedBigInteger('id_users')->nullable();
            $table->string('no_telp');
            $table->unsignedBigInteger('id_alamat')->nullable();
            $table->string('dukuh');
            $table->string('detail_alamat');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade'); 
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
        Schema::dropIfExists('bank_sampah');
    }
}
