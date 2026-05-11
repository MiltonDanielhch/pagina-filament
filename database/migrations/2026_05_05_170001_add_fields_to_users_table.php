<?php

/**
 * Ubicación: `database/migrations/2026_05_05_170001_add_fields_to_users_table.php`
 *
 * Descripción: Añade campos adicionales a users: department, avatar,
 *              two_factor_secret, two_factor_recovery_codes.
 *
 * Dependencias: users_table
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('department')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('department');
            $table->string('two_factor_secret')->nullable()->after('avatar');
            $table->text('two_factor_recovery_codes')->nullable()->after('two_factor_secret');
            $table->softDeletes()->after('remember_token');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn([
                'department',
                'avatar',
                'two_factor_secret',
                'two_factor_recovery_codes',
            ]);
        });
    }
};