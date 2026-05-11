<?php

/**
 * Ubicación: `database/migrations/2026_05_07_050018_create_activity_log_table.php`
 *
 * Descripción: Crea tabla activity_log para spatie/laravel-activitylog:
 *              log_name, description, subject_type, subject_id, causer_type,
 *              causer_id.
 *
 * Dependencias: Ninguna (paquete Spatie)
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->nullableMorphs('subject', 'subject');
            $table->nullableMorphs('causer', 'causer');
            $table->json('properties')->nullable();
            $table->timestamps();
            $table->index('log_name');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}
