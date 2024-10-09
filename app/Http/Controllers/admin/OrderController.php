<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\admin\Orders;
use App\Models\admin\Orders_item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        // Lấy tất cả đơn hàng và các chi tiết liên quan
        $orders = Order::with('orderDetails.product', 'user')->get();

        return view('admin.oders.list', compact('orders'));
    }
}