<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        // Búsqueda por nombre y filtro por nivel (se pueden combinar)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Ordenamiento
        if ($request->sort === 'name') {
            $query->orderBy('name');
        } elseif ($request->sort === 'duration') {
            $query->orderBy('duration', 'desc');
        } else {
            $query->latest();
        }

        // Paginación (conserva búsqueda, filtro y orden en los enlaces)
        $courses = $query->paginate(6)->withQueryString();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        Course::create($this->validar($request));

        return redirect()->route('courses.index')->with('success', 'Curso agregado correctamente.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $course->update($this->validar($request));

        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroyMany(Request $request)
    {
        $request->validate(['ids' => 'required|array'], [
            'ids.required' => 'Selecciona al menos un curso para eliminar.',
        ]);

        Course::whereIn('id', $request->ids)->delete();

        return redirect()->route('courses.index')->with('success', 'Cursos eliminados correctamente.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'level'       => 'required|in:Básico,Intermedio,Avanzado',
            'duration'    => 'required|integer|min:1|max:500',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'integer'  => 'El campo :attribute debe ser un número entero.',
            'in'       => 'El nivel seleccionado no es válido.',
            'min'      => 'El valor de :attribute es demasiado bajo.',
            'max'      => 'El campo :attribute excede el máximo permitido.',
        ], [
            'name'        => 'nombre',
            'description' => 'descripción',
            'level'       => 'nivel',
            'duration'    => 'duración',
        ]);
    }
}