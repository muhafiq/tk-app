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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("gender");
            $table->string("religion");
            $table->string("address");
            $table->string("kartu_keluarga");
            $table->string("akta_kelahiran");
            $table->string("spesific_desease")->nullable();
            $table->string("birth_place");
            $table->foreignId("parent_id")->constrained('parents')->onDelete('cascade');
            $table->unsignedBigInteger("class_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
