<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chapter;
use ZipArchive;
class AdminController extends Controller
{
    //
    public function home()
    {
        return view('admin.home');
    }
    public function storeChapter(Request $request, $truyenId)
{
    $request->validate([
        'chapter_number' => 'required|integer',
        'title' => 'required|string|max:255',
        'content' => 'required|file|mimes:zip|max:10240', // Chỉ cho phép file ZIP
    ]);

    // Lưu file ZIP dưới dạng BLOB
    $content = file_get_contents($request->file('content'));

    Chapter::create([
        'truyen_id' => $truyenId,
        'chapter_number' => $request->chapter_number,
        'title' => $request->title,
        'content' => $content,
    ]);

    return redirect()->back()->with('success', 'Thêm chương mới thành công!');
}
public function viewChapter($chapterId)
{
    $chapter = Chapter::findOrFail($chapterId);

    // Tạo thư mục tạm để giải nén
    $tempDir = storage_path('app/temp/' . $chapter->id);
    if (!file_exists($tempDir)) {
        mkdir($tempDir, 0755, true);
    }

    // Giải nén file ZIP
    $zip = new ZipArchive;
    $filePath = $tempDir . '/chapter.zip';
    file_put_contents($filePath, $chapter->content);

    if ($zip->open($filePath) === true) {
        $zip->extractTo($tempDir);
        $zip->close();
    }

    // Lấy danh sách ảnh từ thư mục tạm
    $images = array_filter(scandir($tempDir), function ($file) use ($tempDir) {
        $filePath = $tempDir . '/' . $file;
        return is_file($filePath) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
    });

    return view('admin.view_chapter', [
        'chapter' => $chapter,
        'images' => $images,
        'tempDir' => $tempDir,
    ]);
}

}