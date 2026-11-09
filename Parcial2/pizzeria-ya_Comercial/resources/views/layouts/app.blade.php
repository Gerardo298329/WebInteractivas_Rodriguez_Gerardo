<!DOCTYPE html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}"><title>@yield('title','Pizzería Ya')</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
@vite(['resources/sass/app.scss','resources/js/app.js'])</head><body>
<nav class="navbar navbar-expand-lg sticky-top glass-bar"><div class="container">
 <a class="navbar-brand logo" href="{{ route('home') }}"><i><b>PIZZA</b></i><span>Pizzería Ya<small>Las mejores pizzas</small></span></a>
 <div class="d-flex align-items-center gap-2 order-lg-3">
  <a class="btn btn-primary" href="{{ route('builder') }}">Pide ahora</a>
  <a class="btn btn-light position-relative" href="{{ route('cart') }}" aria-label="Carrito">🛒<span id="cart-count" class="badge rounded-pill bg-primary position-absolute top-0 start-100 translate-middle">{{ app(\App\Services\CartService::class)->count() }}</span></a>
  <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nv">☰</button></div>
 <div class="collapse navbar-collapse justify-content-center" id="nv"><ul class="navbar-nav fw-semibold">
  @foreach(['menu'=>'Menú','promos'=>'Promociones','nosotros'=>'Nosotros','resenas'=>'Reseñas','ubicacion'=>'Ubicación'] as $id=>$t)
  <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#{{ $id }}">{{ $t }}</a></li>@endforeach</ul></div></div></nav>
@yield('content')
<footer class="py-4 mt-5 bg-dark text-light small"><div class="container">© Pizzería Ya · Instagram · Facebook</div></footer>
<a class="wa" href="https://wa.me/{{ config('pizzeria.whatsapp') }}" target="_blank" aria-label="WhatsApp">WA</a>
</body></html>
