@extends('layouts.app')
@section('content')
@php($c=config('pizzeria'))
<header class="hero">
  <img src="{{ asset('img/hero.jpg') }}" alt="Pizza recién horneada" class="hero-img">
  <div class="container position-relative">
    <div class="glass-box">
      <h1>Las mejores pizzas de San Luis Potosí</h1>
      <p>Ingredientes frescos, masa al momento y entrega a domicilio.</p>
      <a class="btn btn-primary" href="{{ route('builder') }}">Pide ahora</a>
      <a class="btn btn-outline-light" href="#menu">Ver menú</a>
    </div>
  </div>
</header>

<section id="menu" class="py-5"><div class="container"><h2>Menú</h2>
 <ul class="nav nav-pills mb-3">@foreach(['Pizzas','Bebidas','Postres','Extras'] as $k=>$t)
  <li class="nav-item"><button class="nav-link {{ $k?'':'active' }}" data-bs-toggle="pill" data-bs-target="#t{{ $k }}">{{ $t }}</button></li>@endforeach</ul>
 <div class="tab-content">
  <div class="tab-pane fade show active" id="t0"><div class="row g-3">
   @foreach($c['pizzas'] as $key=>$p)<div class="col-12 col-md-6 col-xl-3"><div class="card h-100"><img src="{{ asset('img/pizzas/'.$key.'.jpg') }}" alt="{{ $p['name'] }}" class="card-img-top"><div class="card-body d-flex flex-column">
    <h3 class="h5">{{ $p['name'] }}</h3><div>@foreach($p['tags'] as $t)<span class="badge tag">{{ $t }}</span>@endforeach</div><p class="text-muted small">{{ $p['desc'] }}</p>
    <form method="POST" action="{{ route('cart.quick') }}" class="mt-auto d-flex justify-content-between align-items-center">@csrf<input type="hidden" name="type" value="pizza"><input type="hidden" name="key" value="{{ $key }}">
     <span class="price">desde ${{ $p['price'] }}</span><button class="btn btn-primary btn-sm">Agregar</button></form></div></div></div>@endforeach
   <div class="col-12 col-md-6 col-xl-3"><div class="card build h-100"><div class="card-body d-flex flex-column justify-content-center gap-2"><h3>Arma tu pizza</h3><p>Elige tamaño, masa, queso e ingredientes.</p><a class="btn btn-light align-self-start" href="{{ route('builder') }}">Arma la tuya</a></div></div></div></div></div>
  @foreach(['Bebidas','Postres','Extras'] as $k=>$cat)<div class="tab-pane fade" id="t{{ $k+1 }}"><div class="row g-3">
   @foreach($c['items'][$cat] as $i=>$it)<div class="col-12 col-md-6 col-xl-3"><div class="card h-100"><img src="{{ asset('img/'.strtolower($cat).'/'.\Illuminate\Support\Str::slug($it[0]).'.jpg') }}" alt="{{ $it[0] }}" class="card-img-top" onerror="this.src='{{ asset('img/placeholder.jpg') }}'"><div class="card-body"><h3 class="h5">{{ $it[0] }}</h3><p class="text-muted small">{{ $it[2] }}</p>
    <form method="POST" action="{{ route('cart.quick') }}" class="d-flex justify-content-between align-items-center">@csrf<input type="hidden" name="type" value="item"><input type="hidden" name="cat" value="{{ $cat }}"><input type="hidden" name="idx" value="{{ $i }}"><span class="price">${{ $it[1] }}</span><button class="btn btn-primary btn-sm">Agregar</button></form></div></div></div>@endforeach</div></div>@endforeach
 </div></div></section>

<section id="promos" class="py-5 alt"><div class="container"><h2>Promociones</h2><div class="row g-3">
 @foreach($c['promos'] as $p)<div class="col-md-6 col-xl-4"><div class="card h-100 border-start border-5 border-{{ $p[3] }}"><div class="card-body"><h3 class="h5">{{ $p[0] }}</h3><p class="text-muted">{{ $p[1] }}<br><small>Vigencia: {{ $p[2] }}</small></p><a class="btn btn-primary btn-sm" href="{{ route('builder') }}">Aprovechar</a></div></div></div>@endforeach</div>
 <div class="card mt-3"><div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2"><h3 class="h5 mb-0">Pedidos para eventos y pizzas por mayor</h3><a class="btn btn-outline-primary" href="https://wa.me/{{ $c['whatsapp'] }}?text=Quiero%20cotizar%20un%20pedido" target="_blank">Cotizar por WhatsApp</a></div></div></div></section>

<section id="nosotros" class="py-5"><div class="container"><div class="row g-4 align-items-center"><div class="col-md-6"><h2>Quiénes somos</h2><p>Desde hace más de diez años horneamos en el Centro Histórico. Amasamos a diario y usamos ingredientes frescos.</p>
 <div class="row g-2 text-center fw-semibold"><div class="col-4"><div class="card card-body">🍅<br>Frescos</div></div><div class="col-4"><div class="card card-body">🔥<br>Al momento</div></div><div class="col-4"><div class="card card-body">🛵<br>Rápida</div></div></div></div>
 <div class="col-md-6"><img src="{{ asset('img/nosotros/local.jpg') }}" alt="Nuestro local" class="rounded-img nosotros-img"></div></div>
 <div class="row g-2 mt-3">@foreach(['fachada','cocina','equipo','pepperoni','mexicana','mesa'] as $g)<div class="col-6 col-md-4"><img src="{{ asset('img/galeria/'.$g.'.jpg') }}" alt="{{ $g }}" class="rounded-img gal-img"></div>@endforeach</div></div></section>

<section id="resenas" class="py-5 alt"><div class="container"><h2>Reseñas</h2><div class="row g-3">
 @foreach($c['reviews'] as $r)<div class="col-md-6 col-xl-4"><div class="card h-100"><div class="card-body"><div class="stars">{{ str_repeat('★',$r[1]).str_repeat('☆',5-$r[1]) }}</div><p>{{ $r[2] }}</p><b>{{ $r[0] }}</b></div></div></div>@endforeach</div></div></section>

<section id="ubicacion" class="py-5"><div class="container"><h2>Ubicación, horarios y contacto</h2>
 <div class="ph mb-3" style="min-height:260px">MAPA: 3 marcadores con los locales</div>
 <div class="row g-3 mb-3">@foreach($c['locations'] as $l)<div class="col-md-4"><div class="card card-body"><b>{{ $l[0] }}</b><span class="text-muted small">{{ $l[1] }}</span></div></div>@endforeach</div>
 <div class="row g-4"><div class="col-md-6"><table class="table table-borderless bg-white rounded-4 overflow-hidden">@foreach($c['hours'] as $h)<tr><td>{{ $h[0] }}</td><td class="text-end text-muted">{{ $h[1] }}</td></tr>@endforeach</table>
  <p class="small text-muted">Días festivos: horario reducido.</p><a class="btn btn-primary" href="tel:{{ $c['phone'] }}">Llamar</a> <a class="btn btn-outline-primary" href="https://wa.me/{{ $c['whatsapp'] }}" target="_blank">WhatsApp</a></div>
  <div class="col-md-6"><p><b>Envío:</b> ${{ $c['envio'] }} · <b>Pedido mínimo:</b> ${{ $c['minimo'] }}</p><p>Pagos: 💵 Efectivo · 💳 Tarjeta · 🏦 Transferencia</p></div></div></div></section>
@endsection
