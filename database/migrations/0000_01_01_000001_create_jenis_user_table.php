<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('JENIS_USER', function (Blueprint $table) {
            $table->string('id_jenis_user', 3)->primary();
            $table->string('jenis_user', 80)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('JENIS_USER');
    }
};
