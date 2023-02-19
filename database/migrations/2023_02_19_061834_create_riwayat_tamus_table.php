<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTamusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_tamus', function (Blueprint $table) {
            $table->id();
            $table->string("nama_tamu");
            $table->string("no_hp");
            $table->unsignedBigInteger("pegawai_id");
            $table->text("asal_instansi");
            $table->string("bidang");
            $table->string("jabatan");
            $table->string("keperluan");
            $table->text("detail_keperluan")->nullable(true);
            $table->string("tujuan");
            $table->string("jumlah_tamu");
          $table->string("image")->nullable();
            $table->foreign('pegawai_id')->references('id')->on('pegawais');
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
        Schema::dropIfExists('riwayat_tamus');
    }
}