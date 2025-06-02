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
        Schema::create('Admins', function (Blueprint $table) {
            $table->id();
            $table->int("User_ID");
            $table->int("Jabatan");
            $table->string("Gender");
            $table->string("Religion");
            $table->string("Address"); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Admins');
    }
};
