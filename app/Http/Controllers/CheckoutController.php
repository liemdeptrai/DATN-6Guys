<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function showConfirmCheckout(Request $request)
    {
        $cart = session('cart');

        // Kiểm tra giỏ hàng
        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Tính tổng giá trị đơn hàng
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('confirm_checkout', compact('cart', 'totalPrice')); // Tạo view confirm_checkout.blade.php
    }

    public function processCheckout(Request $request)
{
    // Giả sử $cart chứa danh sách sản phẩm trong giỏ hàng
    $cart = session()->get('cart');
    $totalPrice = 0; // Đảm bảo biến này được khởi tạo

    if ($cart) {
        foreach ($cart as $item) {
            if (!isset($item['product_id'])) {
                Log::error('Product ID is missing in cart item:', $item);
                continue;
            }

            // Tính toán tổng giá
            $totalPrice += $item['price'] * $item['quantity'];

            // Lưu chi tiết đơn hàng
            $orderDetail = new OrderDetail();
            // Chú ý rằng bạn nên lưu orderDetail sau khi đơn hàng được lưu
            // Để lấy ID của đơn hàng
            // $orderDetail->order_id = $order->id; // Đặt ID sau khi lưu đơn hàng
            $orderDetail->product_id = $item['product_id'];
            $orderDetail->quantity = $item['quantity'];
            $orderDetail->price = $item['price'];
            $orderDetail->save();
        }
    }

    // Tạo đơn hàng
    $order = new Order();
    $order->name = $request->name;
    $order->address = $request->address;
    $order->phone = $request->phone;
    $order->payment_method = $request->payment_method;
    $order->user_id = auth()->id(); // Hoặc ID người dùng hiện tại
    $order->total_price = $totalPrice; // Đảm bảo này phù hợp với trường trong bảng
    $order->total = $totalPrice; // Nếu bạn có trường tổng, hãy đặt nó như vậy
    $order->status = 'pending'; // Gán giá trị cho status
    $order->save();

    // Lưu lại chi tiết đơn hàng với ID của đơn hàng vừa tạo
    foreach ($cart as $item) {
        $orderDetail = new OrderDetail();
        $orderDetail->order_id = $order->id; // Lưu ID đơn hàng
        $orderDetail->product_id = $item['product_id'];
        $orderDetail->quantity = $item['quantity'];
        $orderDetail->price = $item['price'];
        $orderDetail->save();
    }
    session()->forget('cart'); // Hoặc sử dụng $request->session()->forget('cart');
    // Redirect hoặc trả về phản hồi
    return redirect()->route('checkout.success'); // Đổi tên route nếu cần
}
public function success()
{
    return view('user.success'); // Đổi tên view nếu cần
}
    
}
