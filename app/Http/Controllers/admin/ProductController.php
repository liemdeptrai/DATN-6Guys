<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use App\Models\admin\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function view()
    {
        $products = $this->product->latest()->paginate(5);
        return view('index', compact('products'));
    }

    public function index()
    {
        $product = Product::all();
        return view('admin.products.index', compact('product'));
    }

    public function add()
    {
        $category = Category::get(['id', 'name']);
        return view('admin.products.add', compact('category'));
    }

    public function product()
    {
        $product = Product::all();
        return view('admin.products.index', compact('product'));
    }

    public function store(Request $request)
{
    
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'content' => 'required|string',
        'image' => 'required',
        'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'quantity' => 'required|integer|min:0',
    ]);
    

    $input = $request->except('image');
    
    // Xử lý upload ảnh
    if ($request->hasFile('image')) {
        $images = [];
        foreach ($request->file('image') as $file) {
            $path = $file->store('products', 'public');
            $images[] = $path;
        }
        $input['image'] = json_encode($images);
    }
    // Lưu sản phẩm vào database
    Product::create($input);

    return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
}

    public function show($id) // Phương thức hiển thị chi tiết sản phẩm
    {
        // Tìm sản phẩm theo ID
        $product = Product::find($id);
        
        
        // Giải mã chuỗi JSON thành mảng
        $images = json_decode($product->image);
    
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        // Tính số lượng sản phẩm trong giỏ
        $cartItemCount = array_sum(array_column($cart, 'quantity'));
    
        // Tính tổng giá tiền
        $totalPrice = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        // Trả về view với sản phẩm, ảnh, số lượng sản phẩm và tổng giá
        return view('user.products.detail', compact('product', 'images', 'cartItemCount', 'totalPrice'));
    }

    public function edit($id)
    {
        
        $category = Category::get(['id', 'name']);
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('category', 'product'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);
    $product->sale = $request->has('sale') ? true : false;
    $product->name = $request->name;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->content = $request->content;
    $product->category_id = $request->category_id;
    $product->sale_percentage = $request->sale_percentage; // Lưu tỷ lệ giảm giá

    if ($product->sale_percentage) {
        $product->price = $product->price - ($product->price * ($product->sale_percentage / 100));
    }
    
    if ($request->hasFile('image')) {
        // Xử lý hình ảnh mới nếu có
    }

    $product->save();

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
}

//     public function destroy(string $id)
//     {
//         $category = Product::destroy($id);
//         return redirect()->route('admin.products.index');
//     }

//     public function layouts(string $id)
//     {
//         $product = Product::all();
//         return redirect()->route('admin.products.index');
//     }
    public function stock()
{
    $products = Product::select('image','id', 'name', 'quantity', 'price')->paginate(10); // Hiển thị tên, số lượng và giá
    return view('admin.products.stock', compact('products'));
}
}
