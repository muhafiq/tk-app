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
            $table->enum("gender", ["L", "P"]);
            $table->enum("religion", ["Islam", "Kristen", "Katolik", "Hindu/Budha", "Konghucu"]);
            $table->string("address");
            $table->string("kartu_keluarga");
            $table->string("akta_kelahiran");
            $table->string("spesific_desease")->nullable();
            $table->date("birth_date");
            $table->string("birth_place");
            $table->string("nation");
            $table->foreignId("parent_id")->constrained('parents')->onDelete('cascade');
            $table->foreignId("class_id")->constrained("classrooms")->onDelete("cascade");
            $table->boolean("disabled")->default(false);
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
