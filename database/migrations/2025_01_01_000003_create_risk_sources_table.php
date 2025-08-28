<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('risk_sources')) {
            Schema::create('risk_sources', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->unsignedInteger('sort')->default(0);
                $table->boolean('active')->default(true);
                $table->timestamps();
            });
        } else {
            Schema::table('risk_sources', function (Blueprint $table) {
                if (!Schema::hasColumn('risk_sources', 'sort')) {
                    $table->unsignedInteger('sort')->default(0);
                }
                if (!Schema::hasColumn('risk_sources', 'active')) {
                    $table->boolean('active')->default(true);
                }
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('risk_sources');
    }
};
