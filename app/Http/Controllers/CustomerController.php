<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function getCustomers()
    {
        $customers = Customer::latest()->get()
            ->filter(fn ($customer) => $customer->name > now()->subMonths(3))
            ->paginate(6);

        $orders = DB::table('orders')
            ->select('customer_id', 'totalAll', DB::raw('SUM(totalAll)  as money_total'))
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->groupBy('customer_id', 'totalAll')
            ->get()
            // ->count('')
            ;
        // $orders = Order::all();
            // $orders = DB::table('orders')
            // ->select('customer_id' DB::raw('count(customer_id),SUM(totalAll)  as money_total'))
            // ->join('customers', 'customers.id', '=', 'orders.customer_id')
            // ->groupBy('customer_id', 'totalAll')
            // ->get();
        // $orderAll = Order::where('customer_id', $user->id)->whereIn('purchase_status', $statuses)
        //     ->withCount('orders')->get();
        // $total = 0;
        // foreach($orders as $order){
        //     if($order->customer_id == Auth::guard('customers')->user()->id){

        //         ($total += $order->totalAll);
        //     }
        // }
        // ->withCount('customer_id')->get();
        $customer_id = Auth::guard('customers')->user()->id;
        $customer = Customer::find($customer_id);
        // $orderss = Order::find($id);
        // $orders = DB::table('orders')
        // ->selectRaw( 'customer_id,COUNT(customer_id)')
        // ->where('customer_id', 'customer->id')
        // // ->join('customers', 'customers.id', '=', 'orders.customer_id')
        // ->groupBy('customer_id')
        // ->get();
        // // ;
        $orderCount = Order::where('customer_id', $customer_id)->select('customer_id')->get()->count();

        $result = DB::table('orders')->where('customer_id',$customer_id)->select(
            DB::raw('count(id) as total_order ,SUM(totalAll)  as total_money')
        )->first();
        dd($result->total_money);




        return view('Backend.customers.index', compact('customers','orders','orderCount'));
    }
}
