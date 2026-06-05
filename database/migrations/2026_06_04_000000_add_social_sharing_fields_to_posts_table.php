<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('shared_to_social')->default(false)->after('meta_description');
            $table->timestamp('shared_at')->nullable()->after('shared_to_social');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['shared_to_social', 'shared_at']);
        });
    }
};
