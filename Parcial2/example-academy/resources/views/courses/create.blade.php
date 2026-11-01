@extends('layouts.app')

@section('title', 'Agregar curso')

@section('content')
    <h1 class="mb-3">Agregar curso</h1>
    <x-course-form :action="route('courses.store')" />
@endsection