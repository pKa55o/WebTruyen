<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen;
use App\Models\TruyenCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $truyens = Truyen::with('categories')->get(); // Lấy cả thông tin liên kết thể loại
    return view('admin.truyen.index', compact('truyens'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.truyen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'ten_truyen' => 'required|string|max:255',
        'tac_gia' => 'required|string|max:255',
        'trang_thai' => 'required|string',
        'the_loai' => 'required|array|min:1', // Thể loại phải là mảng
        'mo_ta' => 'required|string',
        'thumbnail' => 'required|mimes:jpg,jpeg,png|max:2048', // Thumbnail giới hạn 2MB
    ]);

    //public/storage/thumbnails
    $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
    //tạo 1 truyện
    $truyen = Truyen::create([
        'ten_truyen' => $validated['ten_truyen'],
        'tac_gia' => $validated['tac_gia'],
        'trang_thai' => $validated['trang_thai'],
        'the_loai' => json_encode($validated['the_loai']), // Lưu thể loại dưới dạng JSON trong bảng `truyen`
        'mo_ta' => $validated['mo_ta'],
        'thumbnail' => $thumbnailPath,
    ]);

    // Liên kết truyện với các thể loại
    foreach ($validated['the_loai'] as $categoryName) {
        $category = Category::where('name', $categoryName)->first();
    
        if ($category) {
            TruyenCategory::create([
                'truyen_id' => $truyen->id,
                'category_id' => $category->id,
            ]);
        }
    }

    return redirect()->route('truyen.create')->with('success', 'Truyện đã được thêm thành công!');
}

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $truyen = Truyen::findOrFail($id); // Tìm truyện theo id
        $categories = Category::all(); // Lấy tất cả thể loại
    
        return view('admin.truyen.edit', compact('truyen', 'categories'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'ten_truyen' => 'required|string|max:255',
        'tac_gia' => 'required|string|max:255',
        'trang_thai' => 'required|string',
        'the_loai' => 'required|array|min:1', // Thể loại phải là mảng
        'mo_ta' => 'required|string',
        'thumbnail' => 'nullable|mimes:jpg,jpeg,png|max:2048', // Chỉ yêu cầu nếu có file
    ]);

    // Tìm truyện theo ID
    $truyen = Truyen::findOrFail($id);

    // Cập nhật thumbnail nếu có
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // Xóa ảnh cũ nếu có
        if ($truyen->thumbnail && Storage::exists('public/' . $truyen->thumbnail)) {
            Storage::delete('public/' . $truyen->thumbnail);
        }

        $truyen->thumbnail = $thumbnailPath; // Cập nhật thumbnail mới
    }

    // Cập nhật thông tin truyện
    $truyen->update([
        'ten_truyen' => $validated['ten_truyen'],
        'tac_gia' => $validated['tac_gia'],
        'trang_thai' => $validated['trang_thai'],
        'mo_ta' => $validated['mo_ta'],
    ]);

    // Xử lý thể loại: Cập nhật mối quan hệ thể loại
    $categoryIds = [];
    foreach ($validated['the_loai'] as $categoryName) {
        // Tìm thể loại theo tên
        $category = Category::where('name', $categoryName)->first();
        if ($category) {
            $categoryIds[] = $category->id; // Lưu ID thể loại
        }
    }

    // Cập nhật mối quan hệ trong bảng truyen_category
    $truyen->categories()->sync($categoryIds); // Cập nhật thể loại liên kết

    return redirect()->route('truyen.index')->with('success', 'Truyện đã được cập nhật thành công!');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $truyen = Truyen::findOrFail($id);
        // Xóa ảnh thumbnail nếu có
        if ($truyen->thumbnail && Storage::exists('public/' . $truyen->thumbnail)) { // Đổi \Storage thành Storage
            Storage::delete('public/' . $truyen->thumbnail);
        }
        // Xóa mối quan hệ trong bảng truyen_category
        $truyen->categories()->detach();
        // Xóa truyện
        $truyen->delete();
        
        return redirect()->route('truyen.index')->with('success', 'Truyện đã được xóa thành công!');
    }
    
}