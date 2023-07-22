<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\TestServices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->only("cart");
    }
    public function cart()
    {
        return view('cart');
    }
    public function addProducttoCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "title" => $product->title,
                "quantity" => 1,
                "price" => $product->new_price,
            ];
        }
        session()->put('cart', $cart);
        // return redirect()->back()->with('success', 'Product has been added to cart!');
    }
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Product added to cart.');
        }
    }
    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
    }

    public function test()
    {
        $test = new TestServices();
        $hii = $test->SimpleTest("hello world");
        dd($hii);
    }

    function GetProducts(){
        $products = Product::all();
        return response()->json($products);
    }
}
