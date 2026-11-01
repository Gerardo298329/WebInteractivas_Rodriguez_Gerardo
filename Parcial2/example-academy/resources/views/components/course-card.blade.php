@props(['course'])

@php
    $color = match ($course->level) {
        'Básico'     => 'bg-success',
        'Intermedio' => 'bg-warning text-dark',
        'Avanzado'   => 'bg-danger',
        default      => 'bg-secondary',
    };
@endphp

<div class="col-12 col-md-6 col-lg-4">
    <div class="card h-100">
        <div class="card-body">
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="ids[]" value="{{ $course->id }}" id="curso{{ $course->id }}">
                <label class="form-check-label" for="curso{{ $course->id }}">Seleccionar</label>
            </div>
            <h5 class="card-title">{{ $course->name }}</h5>
            <p class="card-text">{{ $course->description }}</p>
            <p class="card-text">Nivel: <span class="badge {{ $color }}">{{ $course->level }}</span></p>
            <p class="card-text">Duración: {{ $course->duration }} horas</p>
            <a href="#" class="btn btn-primary">Ver información</a>
        </div>
    </div>
</div>