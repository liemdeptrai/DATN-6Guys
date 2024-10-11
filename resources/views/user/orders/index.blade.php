@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Danh sách đơn hàng của bạn</h2>
        @if ($orders->isEmpty())
            <p>Bạn chưa có đơn hàng nào.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                            <td>{{ $order->status }}</td>
                            <td><a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-info">Xem chi tiết</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
