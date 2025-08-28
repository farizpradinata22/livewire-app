<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('iso_categories')) {
            Schema::create('iso_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->unsignedInteger('sort')->default(0);
                $table->boolean('active')->default(true);
                $table->timestamps();
            });
        } else {
            Schema::table('iso_categories', function (Blueprint $table) {
                if (!Schema::hasColumn('iso_categories', 'sort')) {
                    $table->unsignedInteger('sort')->default(0);
                }
                if (!Schema::hasColumn('iso_categories', 'active')) {
                    $table->boolean('active')->default(true);
                }
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('iso_categories');
    }
};
