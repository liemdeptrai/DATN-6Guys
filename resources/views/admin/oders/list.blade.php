@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Danh sách đơn hàng</h2>
        @if ($orders->isEmpty())
            <p>Không có đơn hàng nào.</p>
        @else
<<<<<<< HEAD
            @php
                $orderStatuses = [
                    'pending' => 'Chờ xác nhận',
                    'confirmed' => 'Đã xác nhận',
                    'shipping' => 'Đang giao hàng',
                    'delivered' => 'Đã giao thành công',
                    'canceled' => 'Đã hủy'
                ];
            @endphp
=======
>>>>>>> 8b9b1fd1fb63bbf43a2a1eb40dd32b15873a30bd
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Phương thức thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết đơn hàng</th>
<<<<<<< HEAD
                        <th>Hành động</th>
=======
>>>>>>> 8b9b1fd1fb63bbf43a2a1eb40dd32b15873a30bd
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
<<<<<<< HEAD
                            <td>
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        @foreach ($orderStatuses as $key => $label)
                                            <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
=======
                            <td>{{ ucfirst($order->status) }}</td>
>>>>>>> 8b9b1fd1fb63bbf43a2a1eb40dd32b15873a30bd
                            <td>
                                <button class="btn btn-info" data-toggle="collapse" data-target="#orderDetails-{{ $order->id }}">
                                    Xem chi tiết
                                </button>
                                <div id="orderDetails-{{ $order->id }}" class="collapse mt-2">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Giá</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderDetails as $detail)
                                                <tr>
<<<<<<< HEAD
                                                    @if($detail->product)
                                                        <td>{{ $detail->product->name }}</td>
                                                    @else
                                                        <td>Sản phẩm không tồn tại</td>
                                                    @endif
=======
                                                    <td>{{ $detail->product->name }}</td>
>>>>>>> 8b9b1fd1fb63bbf43a2a1eb40dd32b15873a30bd
                                                    <td>{{ $detail->quantity }}</td>
                                                    <td>{{ number_format($detail->price, 0, ',', '.') }} VND</td>
                                                    <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }} VND</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
<<<<<<< HEAD
                            <td>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
=======
>>>>>>> 8b9b1fd1fb63bbf43a2a1eb40dd32b15873a30bd
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
