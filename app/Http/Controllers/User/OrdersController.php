<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\Order;

class OrdersController extends Controller
{
    public function index()
    {
        if(Auth::user()->role === 2) {
            return redirect()->route('user.firm.setting.index');
        }

    	$orders = Order::where('user_id', Auth::id())->get();

    	$collection = collect($orders);

    	$unique = $collection->unique('order_group_id');

    	return view('user.orders.index')->with([
    		'orders' => $unique,
    	]);
    }

    public function show($order_group_id)
    {
        $orders = Order::where('order_group_id', $order_group_id)->get();

        return view('user.orders.show')->with([
    		'orders' => $orders,
    		'order_group_id' => $order_group_id
    	]);
    }
}
