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
            Schema::create('transaksis', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->date('tanggal');
                $table->enum('jenis', ['Pemasukan', 'Pengeluaran']);
                $table->integer('nominal');
                $table->string('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }


};
