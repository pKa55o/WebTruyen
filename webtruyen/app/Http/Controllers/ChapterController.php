<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RarArchive\RarArchive;

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
    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        $truyen = Truyen::findOrFail($chapter->truyen_id);
        return view('admin.chapter.edit', compact('chapter', 'truyen'));
    }
    


    
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
    public function destroy($id)
{
    $chapter = Chapter::findOrFail($id);
    $chapter->delete();
    return redirect()->route('chapter.list', $chapter->truyen_id)
                     ->with('success', 'Chapter đã được xóa thành công!');
}

// ============================ Xử Lí Hình Ảnh ============================

public function processRar($content)
{
    // path unrar trên máy, nếu ai đó xài thì nhớ tải unrarw64 về, link vào path sau đó đổi cái path này
    $unrarPath = 'E:\ITStuff\Laragon\laragon\bin\unrar.exe';
    // Tạo file tạm để lưu dữ liệu byte thành file RAR
    $tempRarPath = tempnam(sys_get_temp_dir(), 'rar');
    file_put_contents($tempRarPath, $content);

    // dir giải nén
    $outputDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('rar_');
    if (!mkdir($outputDir, 0777, true)) {
        return [
            'images' => [],
            'status' => 'lỗi dir',
        ];
    }

    // giải nén
    $command = escapeshellcmd("\"$unrarPath\" x -y \"$tempRarPath\" \"$outputDir\"");
    $output = [];
    $returnCode = 0;
    exec($command, $output, $returnCode);
    //lấy ảnh
    $images = [];
    if ($returnCode === 0) { // Kiểm tra nếu lệnh unrar chạy thành công
        foreach (glob($outputDir . '/*.{jpg,jpeg,png}', GLOB_BRACE) as $file) {
            $images[] = 'data:image/' . pathinfo($file, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($file));
        }
    }

    // cleanning
    unlink($tempRarPath);
    array_map('unlink', glob($outputDir . '/*'));
    rmdir($outputDir);
}

public function show($chapterId)
{
    $chapter = Chapter::findOrFail($chapterId);
    $truyen = $chapter->truyen ?? null;
    $result = $this->processRar($chapter->content);

    return view('admin.chapter.view', [
        'chapter' => $chapter,
        'truyen' => $truyen,
        'images' => $result['images'],
        'status' => $result['status'],
    ]);
}

}