<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('risk_types')) {
            Schema::create('risk_types', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->unsignedInteger('sort')->default(0);
                $table->boolean('active')->default(true);
                $table->timestamps();
            });
        } else {
            // Jika tabel sudah ada, pastikan kolom2 baru tersedia
            Schema::table('risk_types', function (Blueprint $table) {
                if (!Schema::hasColumn('risk_types', 'sort')) {
                    $table->unsignedInteger('sort')->default(0);
                }
                if (!Schema::hasColumn('risk_types', 'active')) {
                    $table->boolean('active')->default(true);
                }
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('risk_types');
    }
};
