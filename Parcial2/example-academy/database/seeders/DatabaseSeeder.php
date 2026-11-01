<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cursos = [
        ['Matemáticas', 'Fundamentos de aritmética, álgebra y geometría.', 'Básico', 40],
        ['Biología', 'Estudio de los seres vivos y sus procesos.', 'Básico', 30],
        ['Cálculo', 'Límites, derivadas e integrales.', 'Avanzado', 60],
        ['Artes', 'Introducción al dibujo, color y composición.', 'Intermedio', 25],
        ['Ciencias Naturales', 'Física, química y ciencias de la Tierra.', 'Intermedio', 45],
        ['Programación', 'Lógica, algoritmos y desarrollo de software.', 'Avanzado', 80],
    ];

    foreach ($cursos as [$name, $description, $level, $duration]) {
        Course::create(compact('name', 'description', 'level', 'duration'));
    }
    }
}
