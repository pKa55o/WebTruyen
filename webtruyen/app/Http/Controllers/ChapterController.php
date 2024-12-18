<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($truyenId)
{
    $truyen = Truyen::findOrFail($truyenId);
    $chapters = Chapter::where('truyen_id', $truyenId)->get();
    return view('admin.chapter.index', compact('truyen', 'chapters'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create($truyen_id)
{
    $truyen = Truyen::findOrFail($truyen_id);
    return view('admin.chapter.create', compact('truyen'));
}
public function store(Request $request, $truyen_id)
{
    // Validate dữ liệu đầu vào
    $validated = $request->validate([
        'chapter_number' => 'required|integer',
        'ten_chapter'    => 'required|string|max:255',
        'content'        => 'required|file|mimes:zip,rar,png,jpg|max:67108864', // Tối đa 64MB
    ]);

    // Đọc file nhị phân từ input
    $fileContent = file_get_contents($request->file('content')->getRealPath());

    // Lưu dữ liệu vào database
    Chapter::create([
        'truyen_id'      => $truyen_id,
        'chapter_number' => $validated['chapter_number'],
        'ten_chapter'    => $validated['ten_chapter'],
        'content'        => $fileContent,
    ]);

    //redirect
    return redirect()->route('chapter.list', $truyen_id)
                     ->with('success', 'Chapter đã được thêm thành công!');
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
        // Tìm Chapter cần chỉnh sửa
        $chapter = Chapter::findOrFail($id);
    
        // Lấy thông tin truyện tương ứng với Chapter
        $truyen = Truyen::findOrFail($chapter->truyen_id);
    
        // Trả về view chỉnh sửa Chapter
        return view('admin.chapter.edit', compact('chapter', 'truyen'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $truyen_id, $chapter_id)
{
    $chapter = Chapter::where('id', $chapter_id)
                      ->where('truyen_id', $truyen_id)
                      ->firstOrFail();
    
        // Validate dữ liệu
        $validated = $request->validate([
            'chapter_number' => 'required|integer',
            'ten_chapter'    => 'required|string|max:255',
            'content'        => 'nullable|file|mimes:zip,rar,png,jpg|max:67108864',
        ]);
    
        // Cập nhật dữ liệu
        $chapter->chapter_number = $validated['chapter_number'];
        $chapter->ten_chapter = $validated['ten_chapter'];
    
        // Nếu có file mới, cập nhật
        if ($request->hasFile('content')) {
            $chapter->content = file_get_contents($request->file('content')->getRealPath());
        }
    
        $chapter->save();
    
        return redirect()->route('chapter.list', ['truyen_id' => $truyen_id])
                         ->with('success', 'Chapter đã được cập nhật thành công!');
    }    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Tìm Chapter cần xóa
    $chapter = Chapter::findOrFail($id);

    // Xóa Chapter
    $chapter->delete();

    // Chuyển hướng về danh sách Chapter với thông báo thành công
    return redirect()->route('chapter.list', $chapter->truyen_id)
                     ->with('success', 'Chapter đã được xóa thành công!');
}
public function view($id)
{
    // Tìm Chapter theo ID
    $chapter = Chapter::findOrFail($id);

    // Lấy thông tin truyện tương ứng
    $truyen = Truyen::findOrFail($chapter->truyen_id);

    // Giải nén nội dung từ cột `content` nếu lưu dưới dạng file ZIP
    $images = [];
    if ($chapter->content) {
        $zipPath = storage_path('app/public/temp.zip');
        file_put_contents($zipPath, $chapter->content);

        $zip = new \ZipArchive;
        if ($zip->open($zipPath) === TRUE) {
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileName = $zip->getNameIndex($i);
                $images[] = 'data:image/jpeg;base64,' . base64_encode($zip->getFromName($fileName));
            }
            $zip->close();
            unlink($zipPath);
        }
    }

    // Trả về view hiển thị chapter
    return view('admin.chapter.view', compact('chapter', 'truyen', 'images'));
}

}