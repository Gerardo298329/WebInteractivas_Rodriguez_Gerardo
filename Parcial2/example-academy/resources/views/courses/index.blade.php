@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
    <h1 class="mb-3">Cursos</h1>
    <p>Cursos encontrados: <span id="contador" class="badge bg-secondary">{{ $courses->total() }}</span></p>

    {{-- CONSULTAR: búsqueda por nombre + filtro por nivel --}}
    <form method="GET" action="{{ route('courses.index') }}" class="row g-2 mb-3">
        <input type="hidden" name="sort" value="{{ request('sort') }}">
        <div class="col-12 col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
        </div>
        <div class="col-12 col-md-4">
            <select name="level" class="form-select">
                <option value="">Todos los niveles</option>
                @foreach (['Básico', 'Intermedio', 'Avanzado'] as $nivel)
                    <option value="{{ $nivel }}" @selected(request('level') === $nivel)>{{ $nivel }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Consultar</button>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    {{-- BOTONES DE ACCIÓN Y ORDENAMIENTO --}}
    <div class="mb-3 d-flex flex-wrap gap-2">
        <a href="{{ route('courses.create') }}" class="btn btn-success">Agregar curso</a>
        <button type="button" id="btnActualizar" class="btn btn-warning" data-base="{{ url('courses') }}">Actualizar seleccionado</button>
        <button type="submit" form="formEliminar" class="btn btn-danger">Eliminar seleccionados</button>

        <div class="btn-group ms-md-auto">
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest', 'page' => 1]) }}" class="btn btn-outline-secondary">Más recientes</a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'page' => 1]) }}" class="btn btn-outline-secondary">Nombre A-Z</a>
            <a href="{{ request()->fullUrlWithQuery(['sort' => 'duration', 'page' => 1]) }}" class="btn btn-outline-secondary">Mayor duración</a>
        </div>
    </div>

    {{-- LISTA DE CURSOS (dentro del formulario de eliminación múltiple) --}}
    <form id="formEliminar" method="POST" action="{{ route('courses.destroyMany') }}">
        @csrf
        @method('DELETE')
        <div class="row g-4 mb-4">
            @forelse ($courses as $course)
                <x-course-card :course="$course" />
            @empty
                <div class="col-12 text-center">No se encontraron cursos.</div>
            @endforelse
        </div>
    </form>

    {{ $courses->links() }}
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // Actualizar: debe haber exactamente un curso seleccionado
    $('#btnActualizar').click(function () {
        let marcados = $('input[name="ids[]"]:checked');
        if (marcados.length !== 1) {
            alert('Selecciona exactamente un curso para actualizar.');
            return;
        }
        window.location.href = $(this).data('base') + '/' + marcados.val() + '/edit';
    });

    // Eliminar: pide al menos uno y confirma
    $('#formEliminar').on('submit', function (e) {
        if ($('input[name="ids[]"]:checked').length === 0) {
            e.preventDefault();
            alert('Selecciona al menos un curso para eliminar.');
            return;
        }
        if (!confirm('¿Seguro que quieres eliminar los cursos seleccionados?')) {
            e.preventDefault();
        }
    });

});
</script>
@endpush