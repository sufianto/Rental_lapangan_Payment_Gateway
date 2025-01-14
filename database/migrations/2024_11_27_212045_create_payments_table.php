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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('penyewa_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('penyewa_id');
            $table->string('payment_code');
            $table->decimal('total_amount', 15, 2);
            $table->string('payment_status');
            $table->timestamps();
            $table->foreign('penyewa_id')->references('id')->on('penyewa')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
