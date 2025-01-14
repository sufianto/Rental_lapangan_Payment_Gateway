<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewaTable extends Migration
{
    public function up()
    {
        Schema::create('penyewa', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_penyewa');
            $table->unsignedBigInteger('lapangan_id');
            $table->integer('total_jam');
            $table->dateTime('mulai_sewa');
            $table->dateTime('akhir_sewa');
            $table->date('tanggal_sewa');
            $table->integer('stok_lapangan');
            $table->decimal('biaya_lapangan', 15, 2);
            $table->decimal('total_biaya', 15, 2);
            $table->tinyInteger('status_bayar')->default(0); // 1 = Berhasil, 0 = Gagal
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');

            // Relasi
            $table->foreign('lapangan_id')->references('id')->on('lapangan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penyewa');
    }
}