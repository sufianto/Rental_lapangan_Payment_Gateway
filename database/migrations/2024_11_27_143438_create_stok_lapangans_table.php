<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stok_lapangan', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('biaya_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('biaya_id');
            $table->date('tanggal_sewa');
            $table->dateTime('mulai_sewa');
            $table->dateTime('akhir_sewa');
            $table->integer('stok_tersedia')->default(0);
            $table->timestamps();
            $table->foreign('biaya_id')->references('id')->on('biaya')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_lapangans');
    }
};
