@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Thông tin thanh toán</h2>

    <form action="{{ route('user.checkout.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Họ tên</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
            
        <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="togglePaymentOptions()">Chọn phương thức thanh toán</button>
        </div>
        
        <div id="payment-options" class="payment-options" style="display: none;">
            <div class="form-check">
                <input type="radio" name="payment_method" id="cod" value="cod" class="form-check-input" onclick="togglePaymentDetails('cod')" required>
                <label for="cod" class="form-check-label">Thanh toán khi nhận hàng (COD)</label>
            </div>
            <div class="form-check">
                <input type="radio" name="payment_method" id="qr" value="qr" class="form-check-input" onclick="togglePaymentDetails('qr')" required>
                <label for="qr" class="form-check-label">Thanh toán bằng QR Code</label>
            </div>
        </div>
        
        <div id="payment-details-cod" class="payment-details" style="display: none;">
            <ul>
                <li>Thanh toán trực tiếp cho người giao hàng.</li>
                <li>Chỉ áp dụng cho đơn hàng nội địa.</li>
            </ul>
        </div>
        
        <div id="payment-details-qr" class="payment-details" style="display: none;">
            <ul>
                <li>Quét mã QR bằng ứng dụng ngân hàng của bạn.</li>
                <img src="{{ asset('img/QR.jpg') }}" alt="QR Code" style="max-width: 200px; margin-top: 10px;">
                <li>Vui lòng hoàn thành thanh toán trong 15 phút.</li>
            </ul>
            
        </div>
        
        <script>
            function togglePaymentOptions() {
                const paymentOptions = document.getElementById('payment-options');
                // Chuyển đổi hiển thị của phần tử payment-options
                if (paymentOptions.style.display === 'none') {
                    paymentOptions.style.display = 'block';
                } else {
                    paymentOptions.style.display = 'none';
                }
            }
        
            function togglePaymentDetails(method) {
                // Ẩn tất cả các chi tiết thanh toán
                document.getElementById('payment-details-cod').style.display = 'none';
                document.getElementById('payment-details-qr').style.display = 'none';
        
                // Hiển thị chi tiết thanh toán được chọn
                if (method === 'cod') {
                    document.getElementById('payment-details-cod').style.display = 'block';
                } else if (method === 'qr') {
                    document.getElementById('payment-details-qr').style.display = 'block';
                }
            }
        </script>
        
        <h4>Giỏ hàng của bạn</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Thanh toán</button>
    </form>
</div>

@endsection
