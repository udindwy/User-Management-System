<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('MENU_LEVEL', function (Blueprint $table) {
            $table->string('id_level', 3)->primary();
            $table->string('level', 80)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('MENU_LEVEL');
    }
};
