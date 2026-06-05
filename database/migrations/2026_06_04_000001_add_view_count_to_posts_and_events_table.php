<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('view_count')->default(0)->after('meta_description');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('view_count')->default(0)->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });
    }
};
