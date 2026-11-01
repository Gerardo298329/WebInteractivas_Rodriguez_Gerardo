<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('courses.index'));

Route::delete('courses', [CourseController::class, 'destroyMany'])->name('courses.destroyMany');
Route::resource('courses', CourseController::class)->except('show');