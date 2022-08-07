<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
    public function destroy(Request $request)
    {
        Auth::guard('customers')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        return redirect()->route('login');
    }
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
        if (isset($cart[$id]))
        {
            $cart[$id]['quantity']++;
        } else
        {
            $cart[$id] = [
                "nameVi" => $product->nameVi,
                "quantity" => 1,
                "price" => $product->price,
            ];
        }
        session()->put('cart', $cart);
        $data = [];
        $data['cart'] = session()->has('cart');
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
            $totalCart = number_format(($cart[$request->id]["price"]) * $cart[$request->id]["quantity"]);
            $totalAllCart = 0;
            $TotalAllRefreshAjax = 0;
            foreach ($cart as $id => $details) {
                $totalAllCart = $details['price'] * $details['quantity'];
                $TotalAllRefreshAjax += $totalAllCart;
            }
            session()->put('cart', $cart);
            session()->flash('message', 'Cart updated successfully');
            return response()->json([
                'status' => 'cập nhật thành công',
                'totalCart' => '' . $totalCart,
                'TotalAllRefreshAjax' => '' . number_format($TotalAllRefreshAjax),
            ]);
        }
    }

    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    public function remove(Request $request)
    {
        if ($request->id)
        {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->put('cart', $cart);
            return response()->json(['status' => 'Xóa đơn hàng thành công']);
        }
    }
    public function checkOuts()
    {
        $allProvinces = Provinces::get();
        return view('frontend.checkOut.index', compact('allProvinces'));
    }
    public function GetDistricts(Request $request)
    {

        $province_id = $request->province_id;
        $allDistricts = Districts::where('province_id', $province_id)->get();
        return response()->json($allDistricts);
    }
    public function getWards(Request $request)
    {
        $district_id = $request->district_id;
        $allWards = Wards::where('district_id', $district_id)->get();
        return response()->json($allWards);
    }

    public function order(Request $request)
    {

        if ($request->product_id == null)
        {
            $notification = array(
                'message' => 'Bạn vẫn chưa chọn sản phẩm nào.',
                'alert-type' => 'warning',
            );
            return redirect()->back()->with($notification);
        } else {
            foreach (session('cart') as $id => $details) {

                $product = Product::find($id);
                if ($product->quantity < $details['quantity']) {
                    $notification = array(
                        'message' => 'sản phẩm ' . $product->nameVi . ' chỉ còn ' . $product->quantity,
                        'alert-type' => 'warning',
                    );
                    return redirect()->back()->with($notification);
                }
            }
            $id = Auth::guard('customers')->user()->id;
            $data = Customer::find($id);
            $data->phone = $request->phone;
            $data->ward_id = $request->ward_id;
            $data->district_id = $request->district_id;
            $data->province_id = $request->province_id;
            $data->address = $request->address;
            $data->save();

            $order = new Order;
            $order->customer_id = Auth::guard('customers')->user()->id;
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
