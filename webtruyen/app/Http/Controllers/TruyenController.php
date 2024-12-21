<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen;
use App\Models\TruyenCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class TruyenController extends Controller
{
    public function index()
{
    $truyens = Truyen::with('categories')->get(); // Lấy cả thông tin liên kết thể loại
    return view('admin.truyen.index', compact('truyens'));
}
    public function create()
    {
        //
        return view('admin.truyen.create');
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'ten_truyen' => 'required|string|max:255',
        'tac_gia' => 'required|string|max:255',
        'trang_thai' => 'required|string',
        'the_loai' => 'required|array|min:1',
        'mo_ta' => 'required|string',
        'thumbnail' => 'required|mimes:jpg,jpeg,png|max:2048', //2mb
    ]);
    //public/storage/thumbnails
    $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
    //tạo 1 truyện
    $truyen = Truyen::create([
        'ten_truyen' => $validated['ten_truyen'],
        'tac_gia' => $validated['tac_gia'],
        'trang_thai' => $validated['trang_thai'],
        'the_loai' => json_encode($validated['the_loai']),//lưu dưới dạng json
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
    public function edit($id)
    {
        $truyen = Truyen::findOrFail($id);
        $categories = Category::all();
        return view('admin.truyen.edit', compact('truyen', 'categories'));
    }
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'ten_truyen' => 'required|string|max:255',
        'tac_gia' => 'required|string|max:255',
        'trang_thai' => 'required|string',
        'the_loai' => 'required|array|min:1',
        'mo_ta' => 'required|string',
        'thumbnail' => 'nullable|mimes:jpg,jpeg,png|max:2048',
    ]);
    $truyen = Truyen::findOrFail($id);
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        if ($truyen->thumbnail && Storage::exists('public/' . $truyen->thumbnail)) {
            Storage::delete('public/' . $truyen->thumbnail);
        }
        $truyen->thumbnail = $thumbnailPath;
    }
    $truyen->update([
        'ten_truyen' => $validated['ten_truyen'],
        'tac_gia' => $validated['tac_gia'],
        'trang_thai' => $validated['trang_thai'],
        'mo_ta' => $validated['mo_ta'],
    ]);
    $categoryIds = [];
    foreach ($validated['the_loai'] as $categoryName) {
        $category = Category::where('name', $categoryName)->first();
        if ($category) {
            $categoryIds[] = $category->id;
        }
    }
    $truyen->categories()->sync($categoryIds);
    return redirect()->route('truyen.index')->with('success', 'Truyện đã được cập nhật thành công!');
}
    public function destroy($id)
    {
        $truyen = Truyen::findOrFail($id);
        if ($truyen->thumbnail && Storage::exists('public/' . $truyen->thumbnail)) { // Đổi \Storage thành Storage
            Storage::delete('public/' . $truyen->thumbnail);
        }
        // Xóa mối quan hệ trong bảng truyen_category
        $truyen->categories()->detach();
        $truyen->delete();
        
        return redirect()->route('truyen.index')->with('success', 'Truyện đã được xóa thành công!');
    }
    
}