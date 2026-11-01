@extends('layouts.app')

@section('title', 'Actualizar curso')

@section('content')
    <h1 class="mb-3">Actualizar curso</h1>
    <x-course-form :action="route('courses.update', $course)" method="PUT" :course="$course" />
@endsection