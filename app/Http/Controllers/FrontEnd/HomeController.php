<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use App\Models\Oder;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Provinces;
use App\Models\User;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        // dd($cart);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
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
        if ($request->id && $request->quantity) {
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
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('message', 'Product removed successfully');
        }
    }
    public function checkout()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $provinces = Provinces::all();
        $districts = Districts::where('province_id', $user->province_id)->get();
        $wards = Wards::where('district_id', $user->district_id)->get();
        // $this->addToCart($id);
        return view(
            'FrontEnd.checkouts',
            [
                'user' => $user,
                'provinces' => $provinces,
                'districts' => $districts,
                'wards' => $wards,
            ]
        );
    }
    public function order(Request $request)
    {
        dd($request->all());

        // $order = Order::with('products')->where('user_id', auth()->id())->get();
        // $products = Product::select('id', ''qu>antity')->whereIn('id', $order->pluck('product_id'))->pluck('quantity','id');
        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->status    = '0';
        $order->payment_method    = '0';
        $order->note = $request->note;
        $order->totalAll = $request->totalAll;
        if ($order) {
            if (!$request->getContent() == null) {
                $count_product = count($request->product_id);

                for ($i = 0; $i < $count_product; $i++) {

                    $orderItem = new Order_detail();
                    $orderItem->product_id = $request->product_id[$i];
                    $orderItem->quantity = $request->quantity[$i];
                    $orderItem->total = $request->total[$i];
                }
            }

            try {
                $order->order_details()->save($orderItem);
                $notification = [
                    'message' => 'Đặt hàng thành công',
                    'alert-type' => 'success',
                ];
                return redirect()->back()->with($notification);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                $notification = [
                    'message' => 'Đặt hàng thất bại',
                    'alert-type' => 'warning',
                ];

                return redirect()->back()->with($notification);
            }
        }
    }
}
