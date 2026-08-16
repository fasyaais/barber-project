<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('price')->nullable()->after('description');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->string('type')->nullable()->after('description');
            $table->string('salary')->nullable()->after('type');
            $table->string('loc')->nullable()->after('salary');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['type', 'salary', 'loc']);
        });
    }
};