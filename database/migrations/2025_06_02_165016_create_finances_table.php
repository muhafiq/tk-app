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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']); // pemasukan / pengeluaran
            $table->string('category'); // spp, rekreasi, gaji, atk, dll
            $table->text('description')->nullable(); // keterangan
            $table->decimal('amount', 12, 2); // nominal
            $table->date('date');
            $table->unsignedBigInteger('student_id')->nullable(); // jika transaksi berhubungan dengan siswa
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
