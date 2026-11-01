@props(['action', 'method' => 'POST', 'course' => null])

<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="mb-3">
        <label class="form-label" for="name">Nombre</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $course?->name) }}">
    </div>

    <div class="mb-3">
        <label class="form-label" for="description">Descripción</label>
        <textarea id="description" name="description" class="form-control" rows="2">{{ old('description', $course?->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label" for="level">Nivel</label>
        <select id="level" name="level" class="form-select">
            @foreach (['Básico', 'Intermedio', 'Avanzado'] as $nivel)
                <option value="{{ $nivel }}" @selected(old('level', $course?->level ?? 'Intermedio') === $nivel)>{{ $nivel }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label" for="duration">Duración (horas)</label>
        <input type="number" id="duration" name="duration" class="form-control" min="1" value="{{ old('duration', $course?->duration) }}">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
</form>