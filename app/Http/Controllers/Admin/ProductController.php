<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = $request->input('sort', 'id'); // Mặc định sắp xếp theo ID
        $sortDirection = $request->input('direction', 'asc'); // Mặc định là tăng dần

        $products = Product::with('category') // Lấy thông tin danh mục
            ->orderBy($sortField, $sortDirection)
            ->paginate(15);

        return view('admin.products.index', compact('products', 'sortField', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0', // Ngăn giá trị âm
            'view' => 'nullable|integer', // Có thể bỏ qua nếu không cần thiết
            'category_id' => 'required|exists:categories,id', // Kiểm tra danh mục có tồn tại
        ]);

        // Tính toán status dựa trên quantity
        $status = $request->quantity > 0 ? 'in stock' : 'out of stock';

        // Tạo sản phẩm
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image ? $request->image->store('images/products', 'public') : null, // Lưu hình ảnh nếu có
            'price' => $request->price,
            'quantity' => $request->quantity,
            'view' => $request->view ?? 0,
            'status' => $status, // Thiết lập status
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0', // Ngăn giá trị âm
            'view' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Cập nhật thông tin sản phẩm
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        if ($request->hasFile('image')) {
            $product->image = $request->image->store('images/products', 'public');
        }
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->view = $request->input('view') ?? 0;
        $product->status = $product->quantity > 0 ? 'in stock' : 'out of stock'; // Cập nhật status
        $product->category_id = $request->input('category_id');
        $product->save(); // Lưu thay đổi

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
