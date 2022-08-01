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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Raw;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('FrontEnd.product.index', compact('products'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('FrontEnd.addToCart.index');
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
        $data = [];
        $data['cart']= session()->has('cart');
        return response()->json($data);
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
        }
        return response()->json(['message', 'Product removed successfully']);
    }
    public function checkout()
    {
        // $id = Auth::user()->id ?? '';
        // $user = User::find($id);
        // $provinces = Provinces::all();
        // $districts = Districts::where('province_id', $user->province_id)->get();
        // $wards = Wards::where('district_id', $user->district_id)->get();
        // $this->addToCart($id);
        return view(
            'FrontEnd.checkOut.index',
            [
                // 'user' => $user,
                // 'provinces' => $provinces,
                // 'districts' => $districts,
                // 'wards' => $wards,
            ]
        );
    }
    public function order(Request $request)
    {

        // DB::transaction(function () use( $request){
        if ($request->product_id == null) {
            $notification = array(
                'message' => 'Bạn vẫn chưa chọn sản phẩm nào để mua.',
                'alert-type' => 'warning',
            );
            return redirect()->back()->with($notification);
        } else {
            foreach (session('cart') as $id => $details) {
                // dd($details['quantity']);
                $product = Product::find($id);
                if ($product->quantity < $details['quantity']) {
                    $notification = array(
                        'message' => 'sản phẩm ' . $product->nameVi . ' chỉ còn ' . $product->quantity,
                        'alert-type' => 'warning',
                    );
                    return redirect()->back()->with($notification);
                }
            }
            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->status    = '0';
            $order->payment_method    = '0';
            $order->note = $request->note;
            $order->totalAll = $request->totalAll;
            $order->save();
        }
        try {
            if ($order) {

                $count_product = count($request->product_id);
                for ($i = 0; $i < $count_product; $i++) {
                    $orderItem = new Order_detail();
                    $orderItem->order_id =  $order->id;
                    $orderItem->product_id = $request->product_id[$i];
                    $orderItem->quantity = $request->quantity[$i];
                    $orderItem->total = $request->total[$i];
                    $orderItem->save();
                    session()->forget('cart');
                    DB::table('products')
                        ->where('id', '=', $orderItem->product_id)
                        ->decrement('quantity', $orderItem->quantity);
                }
                $notification = [
                    'message' => 'Đặt hàng thành công',
                    'alert-type' => 'success',
                ];
                return redirect()->back()->with($notification);
            }
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
