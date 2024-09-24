<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = $request->input('sort', 'id'); // Mặc định sắp xếp theo ID
        $sortDirection = $request->input('direction', 'asc'); // Mặc định là tăng dần

        $categories = Category::with('parent') // Lấy thông tin danh mục cha
            ->orderBy($sortField, $sortDirection)
            ->paginate(15);

        return view('admin.categories.index', compact('categories', 'sortField', 'sortDirection'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
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
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Create the category
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        // Chuyển hướng về trang danh sách categories với thông báo thành công
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::all();
        return view('admin.categories.show', compact('categories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get(); // Lấy danh sách các category cha
        return view('admin.categories.edit', compact('category', 'categories'));
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
            'parent_id' => 'nullable|exists:categories,id', // Nếu có parent_category thì kiểm tra xem nó có tồn tại không
        ]);

        // Tìm category theo ID
        $category = Category::findOrFail($id);

        // Cập nhật thông tin category
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->parent_id = $request->input('parent_id');
        $category->save(); // Lưu thay đổi

        // Thêm thông báo thành công
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
