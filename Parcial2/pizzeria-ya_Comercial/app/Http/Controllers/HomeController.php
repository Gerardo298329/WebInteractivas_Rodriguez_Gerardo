<?php
namespace App\Http\Controllers;
use App\Services\CartService;
class HomeController extends Controller {
 public function index(){ return view("home"); }
 public function builder(CartService $cart,$i=null){
  $edit=($i!==null)?($cart->all()[$i]??null):null;
  return view("builder",["edit"=>$edit,"editIndex"=>$edit?(int)$i:null]);
 }
}
