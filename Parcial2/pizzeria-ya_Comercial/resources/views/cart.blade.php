@extends('layouts.app')
@section('content')
<div class="container py-5" style="max-width:760px"><h2>Carrito</h2>
@forelse($items as $i=>$x)
 <div class="card mb-2"><div class="card-body"><div class="d-flex justify-content-between"><h3 class="h5">{{ $x['name'] }}</h3><span class="price">${{ $x['price'] }}</span></div>
  @if($x['type']==='pizza')<p class="text-muted small mb-2">{{ $x['size'] }} · {{ $x['masa'] }} · {{ $x['queso'] }}<br>{{ collect($x['ings'])->pluck('n')->implode(', ') ?: 'Sin ingredientes' }}</p>@endif
  <div class="d-flex gap-2">@if($x['type']==='pizza')<a class="btn btn-light btn-sm" href="{{ route('builder',$i) }}">Editar</a>@endif
   <form method="POST" action="{{ route('cart.destroy',$i) }}">@csrf @method('DELETE')<button class="btn btn-outline-primary btn-sm">Eliminar</button></form></div></div></div>
@empty<div class="card card-body text-center py-5"><h3>Tu carrito está vacío</h3><a class="btn btn-primary mt-2 align-self-center" href="{{ route('builder') }}">Arma la tuya</a></div>@endforelse
@if($items)<div class="card mt-3"><div class="card-body"><div class="d-flex justify-content-between"><b>Total</b><span class="price fs-3">${{ $total }}</span></div>
 <div class="d-flex flex-wrap gap-2 mt-3"><a class="btn btn-light" href="{{ route('builder') }}">Agregar otra</a><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#mCancel">Cancelar</button>
  <form method="POST" action="{{ route('checkout') }}">@csrf<button class="btn btn-primary">Realizar pedido</button></form></div></div></div>@endif</div>
<div class="modal fade" id="mCancel" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-body"><h3 class="h5">¿Cancelar el pedido?</h3><p>Se vaciará tu carrito.</p>
 <div class="d-flex justify-content-end gap-2"><button class="btn btn-light" data-bs-dismiss="modal">Seguir pidiendo</button><form method="POST" action="{{ route('cart.clear') }}">@csrf @method('DELETE')<button class="btn btn-primary">Cancelar pedido</button></form></div></div></div></div></div>
@if(session('ok'))<div class="modal fade" id="mOk" tabindex="-1" data-show><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-body text-center"><h3 class="h4">¡Pedido realizado!</h3><p>Gracias. Te avisaremos cuando salga del horno.</p><button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button></div></div></div></div>@endif
@endsection
