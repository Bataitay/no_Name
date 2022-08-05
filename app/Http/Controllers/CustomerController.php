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
        $customers = Customer::where('created_at', '>', now()->subMonths(3))
                    ->orderBy('id','DESC')
                    ->paginate(6)
                    ;
        foreach ($customers as $customer) {
            $result = DB::table('orders')->where('customer_id',$customer->id)->select(
                DB::raw('count(id) as total_orders ,SUM(totalAll)  as total_money')
            )->first();

            $customer->total_orders = $result->total_orders;
            $customer->total_money = $result->total_money;
        }


        return view('Backend.customers.index', compact('customers'));
    }
}
