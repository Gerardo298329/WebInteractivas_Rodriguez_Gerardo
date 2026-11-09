<?php
use App\Http\Controllers\{HomeController,CartController};
use Illuminate\Support\Facades\Route;
Route::get("/",[HomeController::class,"index"])->name("home");
Route::get("/arma-tu-pizza/{i?}",[HomeController::class,"builder"])->name("builder");
Route::get("/carrito",[CartController::class,"index"])->name("cart");
Route::post("/carrito/pizza",[CartController::class,"storePizza"])->name("cart.pizza");
Route::post("/carrito/rapido",[CartController::class,"quick"])->name("cart.quick");
Route::delete("/carrito/{i}",[CartController::class,"destroy"])->name("cart.destroy");
Route::delete("/carrito",[CartController::class,"clear"])->name("cart.clear");
Route::post("/pedido",[CartController::class,"checkout"])->name("checkout");
