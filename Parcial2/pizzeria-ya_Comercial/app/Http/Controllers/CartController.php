<?php
namespace App\Http\Controllers;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class CartController extends Controller {
 public function __construct(private CartService $cart){}
 public function index(){ return view("cart",["items"=>$this->cart->all(),"total"=>$this->cart->total()]); }
 public function storePizza(Request $r){
  $c=config("pizzeria");
  $d=$r->validate(["style"=>["required",Rule::in(array_keys($c["pizzas"]))],"size"=>["required",Rule::in(array_keys($c["sizes"]))],"masa"=>["required",Rule::in(array_keys($c["masas"]))],"queso"=>["required",Rule::in(array_keys($c["quesos"]))],
   "ings"=>"array","ings.*.n"=>[Rule::in(array_keys($c["ingredients"]))],"ings.*.l"=>"integer|between:0,2","index"=>"nullable|integer"]);
  $this->cart->addPizza($d,$d["index"]??null);
  return response()->json(["count"=>$this->cart->count(),"total"=>$this->cart->total()]);
 }
 public function quick(Request $r){
  $c=config("pizzeria");
  if($r->type==="pizza"&&isset($c["pizzas"][$r->key])){ $s=$c["pizzas"][$r->key];
   $this->cart->addPizza(["style"=>$r->key,"size"=>"Mediana","masa"=>"Tradicional","queso"=>"Mozzarella","ings"=>array_map(fn($n)=>["n"=>$n,"l"=>1],$s["ings"])]);
  } elseif($r->type==="item"&&isset($c["items"][$r->cat][(int)$r->idx])){ [$n,$p]=$c["items"][$r->cat][(int)$r->idx]; $this->cart->addItem($n,$p); }
  return redirect()->route("cart");
 }
 public function destroy(int $i){ $this->cart->remove($i); return back(); }
 public function clear(){ $this->cart->clear(); return redirect()->route("cart"); }
 public function checkout(){ if(!$this->cart->count()) return back(); /* TODO: guardar pedido en BD / WhatsApp */ $this->cart->clear(); return redirect()->route("cart")->with("ok",true); }
}
