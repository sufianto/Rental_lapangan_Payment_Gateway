<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lapangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lapangan')->unique();
            // $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('status');
            
            $table->text('detail');
            $table->string('foto'); // Thumbnail image
            // $table->decimal('biaya_lapangan', 10, 2);
            $table->string('kelas_lapangan');
            // $table->integer('stok_lapangan');
            $table->foreign('kelas_lapangan')->references('kelas_lapangan')->on('biaya')->onDelete('cascade');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapanagan');
    }
};
