<?php
namespace App\Services;
/** Carrito en sesión + cálculo de precios en el servidor. Luego se cambia por BD sin tocar los controladores. */
class CartService {
 public function all():array { return session("cart",[]); }
 public function count():int { return count($this->all()); }
 public function total():int { return array_sum(array_column($this->all(),"price")); }
 public function price(array $p):int {
  $c=config("pizzeria"); $s=$c["pizzas"][$p["style"]];
  $t=$s["price"]+$c["sizes"][$p["size"]]+$c["masas"][$p["masa"]]+$c["quesos"][$p["queso"]];
  foreach($p["ings"]??[] as $g){
   $cost=$c["ingredients"][$g["n"]]; $extra=(int)$g["l"]===2;
   $t+= in_array($g["n"],$s["ings"]) ? ($extra?$cost:0) : ($extra?2*$cost:$cost); // regla de precio
  }
  return $t;
 }
 public function addPizza(array $p,?int $i=null):void {
  $item=["type"=>"pizza","name"=>config("pizzeria.pizzas.{$p["style"]}.name"),"style"=>$p["style"],"size"=>$p["size"],"masa"=>$p["masa"],"queso"=>$p["queso"],"ings"=>array_values($p["ings"]??[]),"price"=>$this->price($p)];
  $cart=$this->all(); if($i!==null&&isset($cart[$i])) $cart[$i]=$item; else $cart[]=$item; session(["cart"=>array_values($cart)]);
 }
 public function addItem(string $name,int $price):void { $c=$this->all(); $c[]=["type"=>"item","name"=>$name,"price"=>$price]; session(["cart"=>$c]); }
 public function remove(int $i):void { $c=$this->all(); unset($c[$i]); session(["cart"=>array_values($c)]); }
 public function clear():void { session()->forget("cart"); }
}
