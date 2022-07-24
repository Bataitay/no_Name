<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('FrontEnd.index', compact('products'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('FrontEnd.cart');
    }

    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    public function addToCart($id)
    {
        // dd(session()->invalidate());

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        // dd($cart);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }
     else {
            $cart[$id] = [
                "nameVi" => $product->nameVi,
                "quantity" => 1,
                "price" => $product->price,
            ];
        }
        session()->put('cart', $cart);
        // dd(session('cart'));

       return redirect()->back()->with('message', 'Product added to cart successfully!');
    }

    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('message', 'Cart updated successfully');
        }
    }

    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('message', 'Product removed successfully');
        }
    }
    public function order(){

    }
}
