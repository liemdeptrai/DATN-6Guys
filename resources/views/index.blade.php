@extends('layouts.app')

@section('content')
    <section class="section recent-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Recently Sold Items</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 15px;">
                @foreach ($products as $item)
                    <div class="col" style="flex: 1 0 20%; max-width: 20%;">
                        <div class="product-card">
                            <div class="product-media">
                                @if ($item->sale) 
                                    <div class="product-label">
                                        <label class="label-text sale">Sale</label> <!-- Hiển thị nhãn sale -->
                                    </div>
                                @else
                                    
                                @endif
                        
                                <button class="product-wish wish"><i class="fas fa-heart"></i></button>
                                
                                <td class="centered">
                                    @if ($item->image)
                                        @php
                                            $images = json_decode($item->image);
                                        @endphp
                                        @if (is_array($images) || is_object($images)) 
                                            @foreach ($images as $image)
                                                <img src="{{ asset('storage/' . $image) }}" class="img-fluid" alt="Product Image" style="width: 150px; height: 150px; margin: 40px;">
                                            @endforeach
                                        @else
                                            <p>Invalid image data</p>
                                        @endif
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </td>
                        
                                <div class="product-widget">
                                    <a title="Product Compare" href="compare.html" class="fas fa-random"></a>
                                    <a title="Product Video" href="" class="venobox fas fa-play" data-autoplay="true" data-vbtype="video"></a>
                                    <a title="Product View" href="{{ route('products.show', $item->id) }}" class="fas fa-eye"></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h6 class="product-name">
                                    <a href="product-video.html">{{ $item->name }}</a>
                                </h6>
                                <h6 class="product-price">
                                    @if ($item->sale_percentage)
                                        <span class="old-price" style="text-decoration: line-through;">{{ $item->price }}<small>/</small></span>
                                        <span class="new-price" style="color:red;">{{ $item->price - ($item->price * ($item->sale_percentage / 100)) }}<small> VND</small></span>
                                    @else
                                        <span>{{ $item->price }}<small> VND</small></span>
                                    @endif
                                </h6>
                        
                                <form id="addToCartForm" action="{{ route('cart.add', ['itemId' => $item->id]) }}" method="POST">
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                </form>
                                <div class="product-action">
                                    <button class="action-minus" title="Quantity Minus">
                                        <i class="icofont-minus"></i>
                                    </button>
                                    <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                                    <button class="action-plus" title="Quantity Plus">
                                        <i class="icofont-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25">
                        <a href="shop-4column.html" class="btn btn-outline">
                            <i class="fas fa-eye"></i><span>Show More</span>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    <style>
        .product-label {
    position: absolute; /* Nếu bạn muốn định vị nhãn */
    top: 10px; /* Điều chỉnh vị trí nhãn */
    left: 10px; /* Điều chỉnh vị trí nhãn */
    z-index: 10; /* Đảm bảo nhãn nằm trên cùng */
}

.label-text.sale {
    background-color: red; /* Màu nền của nhãn */
    color: white; /* Màu chữ */
    padding: 5px 10px; /* Khoảng cách bên trong nhãn */
    border-radius: 5px; /* Góc bo tròn */
    font-weight: bold; /* Chữ đậm */
}
        </style>
    </section>

@endsection
