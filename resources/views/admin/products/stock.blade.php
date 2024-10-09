@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Quản lý kho hàng</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng còn</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->image}}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
