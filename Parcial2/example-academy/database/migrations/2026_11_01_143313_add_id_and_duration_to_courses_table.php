<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1) CLAVE PRIMARIA
        // SQLite no permite agregar una clave primaria con ALTER TABLE,
        // así que se reconstruye la tabla conservando los datos.
        // (En MySQL bastaría con $table->id() dentro de Schema::table).
        Schema::rename('courses', 'courses_old');

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('level');
            $table->timestamps();
        });

        DB::statement('INSERT INTO courses (name, description, level, created_at, updated_at)
                       SELECT name, description, level, created_at, updated_at FROM courses_old');

        Schema::drop('courses_old');

        // 2) CAMPO DE DURACIÓN (en horas)
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedSmallInteger('duration')->default(10);
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};