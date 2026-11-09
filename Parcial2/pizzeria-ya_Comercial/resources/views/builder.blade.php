@extends('layouts.app')
@section('content')
<div class="container py-4" style="max-width:1000px">
 <div class="d-flex justify-content-between align-items-center mb-2"><b id="st">Paso 1 de 6</b><a class="btn btn-light btn-sm" href="{{ route('home') }}">Cerrar</a></div>
 <div class="progress mb-4"><div class="progress-bar" id="pg"></div></div>
 <div class="row g-4"><div class="col-lg-8"><h2 id="sh"></h2><div id="sb"></div>
  <div class="d-flex gap-2 mt-3"><button class="btn btn-light" id="bk">Atrás</button><button class="btn btn-primary" id="nx">Siguiente</button></div></div>
  <div class="col-lg-4"><div class="card sticky-top" style="top:90px"><div class="card-body"><b>Tu pizza</b><div id="ts" class="text-muted small my-1"></div><div class="price fs-2" id="tp">$0</div></div></div></div></div></div>
<div class="modal fade" id="mIng" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-body">
 <h3 class="h5">Agregar ingrediente</h3><input id="q" class="form-control rounded-pill my-2" placeholder="🔍 Buscar"><div id="il"></div>
 <div class="d-flex justify-content-end gap-2 mt-3"><button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button><button class="btn btn-primary" id="ab">Agregar (0)</button></div></div></div></div></div>
<div class="modal fade" id="mAsk" data-bs-backdrop="static" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-body"><h3 class="h5">¿Deseas agregar otra pizza o realizar el pedido?</h3>
 <div class="d-flex justify-content-end gap-2 mt-3"><a class="btn btn-light" href="{{ route('home') }}">Cancelar</a><a class="btn btn-outline-primary" href="{{ route('builder') }}">Otra pizza</a><a class="btn btn-primary" href="{{ route('cart') }}">Realizar pedido</a></div></div></div></div></div>
<script>window.PZ=@json(config('pizzeria')+['edit'=>$edit,'editIndex'=>$editIndex]);window.PZ_URL="{{ route('cart.pizza') }}";</script>
@endsection
