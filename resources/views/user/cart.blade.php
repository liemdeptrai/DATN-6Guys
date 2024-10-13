@extends('layout')

@section('content')

{{-- <div class="container">
    <h2>Giỏ hàng của bạn</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $item)
                    <tr>
                        <td>
                            @if(isset($item['image']))
                                @php
                                    $images = json_decode($item['image'], true); // Giải mã JSON
                                @endphp
                                @if(is_array($images) && count($images) > 0)
                                    <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $item['name'] }}" style="width: 100px; height: auto;">
                                @else
                                    <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" style="width: 100px; height: auto;">
                                @endif
                            @else
                                <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" style="width: 100px; height: auto;">
                            @endif
                        </td>
                        <td>{{ $item['name'] }}</td>
                        
                        <td>
                            @if(isset($item['id'])) 
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" required min="1">
                                <button type="submit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg></button>
                            </form>
                            @else
                                <span>Không có thông tin sản phẩm</span>
                            @endif
                        </td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td> <!-- giá -->
                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td> <!-- tổng giá -->
                        <td>
                            @if(isset($item['id']))
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            @else
                                <span>Không thể xóa sản phẩm</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>

        <h4>Tổng giá trị: 
            {{ number_format(array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, session('cart'))), 0, ',', '.') }} VNĐ
        </h4>
        
        <form action="{{ route('user.checkout.confirm') }}" method="GET">
            @csrf
            <!-- Các input cho thông tin thanh toán (như tên, địa chỉ, số điện thoại...) -->
            <button type="submit" class="btn btn-primary">Xác nhận thanh toán</button>
        </form>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</div>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}
<!-- Shopping Cart -->
<form class="bg0 p-t-75 p-b-85" method="POST" action="">
    @csrf
    @if(session('cart') && count(session('cart')) > 0)
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                    <th class="column-6">Action</th>
                                </tr>

                                @foreach(session('cart') as $item)
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                @if(isset($item['image']))
                                                    @php
                                                        $images = json_decode($item['image'], true); // Giải mã JSON
                                                    @endphp
                                                    @if(is_array($images) && count($images) > 0)
                                                        <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $item['name'] }}" style="width: 100px; height: auto;">
                                                    @else
                                                        <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" style="width: 100px; height: auto;">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" style="width: 100px; height: auto;">
                                                @endif
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item['name'] }}</td>
                                        <td class="column-3">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity[{{ $item['id'] }}]" value="{{ $item['quantity'] }}" required min="1">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                                        <td class="column-6">
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
                                <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Apply coupon
                                </div>
                            </div>

                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                <button type="submit">Update Cart</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">Cart Totals</h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">Subtotal:</span>
                            </div>
                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    {{ number_format(array_sum(array_map(function($item) {
                                        return $item['price'] * $item['quantity'];
                                    }, session('cart'))), 0, ',', '.') }} VNĐ
                                </span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Shipping:</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    There are no shipping methods available. Please double check your address, or contact us if you need any help.
                                </p>
                            </div>
                        </div>

                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">Total:</span>
                            </div>
                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2">
                                    {{ number_format(array_sum(array_map(function($item) {
                                        return $item['price'] * $item['quantity'];
                                    }, session('cart'))), 0, ',', '.') }} VNĐ
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Proceed to Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</form>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@endsection
