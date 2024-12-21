<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;
use ZipArchive;

class ChapterController extends Controller
{
    public function index($truyenId)
{
    $truyen = Truyen::findOrFail($truyenId);
//lấy toàn bộ dữ liệu (chapter) từ truyenId nếu trong db có truyenId tương ứng
    $chapters = Chapter::where('truyen_id', $truyenId)->get();
//hàm compact dùng để tạo 1 mảng, 2 biến trong hàm tương ứng với 2 trường thông tin mà nó lấy
//tức là trong db lấy 4 nhưng chỉ tạo mảng với 2 
    return view('admin.chapter.index', compact('truyen', 'chapters'));
}

// ============================ Create ============================
     public function create($truyen_id)
{
    $truyen = Truyen::findOrFail($truyen_id);
    return view('admin.chapter.create', compact('truyen'));
}

// ============================ Edit ============================
public function edit($id)
{
    $chapter = Chapter::findOrFail($id);
    $truyen = Truyen::findOrFail($chapter->truyen_id);
    return view('admin.chapter.edit', compact('chapter', 'truyen'));
}

// ============================ Destroy ============================
public function destroy($id)
{
    $chapter = Chapter::findOrFail($id);
    $chapter->delete();
    return redirect()->route('chapter.list', $chapter->truyen_id)
                     ->with('success', 'Chapter đã được xóa thành công!');
}

    // ============================ Store ============================
public function store(Request $request, $truyen_id)
{
    //validating (đk)
    $validated = $request->validate([
        'chapter_number' => 'required|integer',
        'ten_chapter'    => 'required|string|max:255',
        'content'        => 'required|file|mimes:zip,rar,png,jpg|max:67108864', //64mb
    ]);
    //đọc input từ form name content, khi này file được tải lên sẽ ở dir temp của máy và sẽ lưu luôn vào fileContent dưới dạng byte
    $fileContent = file_get_contents($request->file('content')->getRealPath());
    //tạo 1 kiểu chapter đẻ lưu vào db, create([]) có công dụng tạo 1 row mới trong db chapter
    Chapter::create([
        'truyen_id'      => $truyen_id,
        'chapter_number' => $validated['chapter_number'],
        'ten_chapter'    => $validated['ten_chapter'],
        'content'        => $fileContent,
    ]);
    return redirect()->route('chapter.list', $truyen_id)
                     ->with('success', 'Chapter đã được thêm thành công!');
}


    // ============================ Update ============================
    public function update(Request $request, $truyen_id, $chapter_id)
{
    $chapter = Chapter::where('id', $chapter_id)
                      ->where('truyen_id', $truyen_id)
                      ->firstOrFail();
        //validating
        $validated = $request->validate([
            'chapter_number' => 'required|integer',
            'ten_chapter'    => 'required|string|max:255',
            'content'        => 'nullable|file|mimes:zip|max:67108864',
        ]);
        //update
        $chapter->chapter_number = $validated['chapter_number'];
        $chapter->ten_chapter = $validated['ten_chapter'];
        if ($request->hasFile('content')) {
            $chapter->content = file_get_contents($request->file('content')->getRealPath());
        }
        $chapter->save();
        return redirect()->route('chapter.list', ['truyen_id' => $truyen_id])
                         ->with('success', 'Chapter đã được cập nhật thành công!');
    }    


// ============================ Xử Lí Hình Ảnh ============================

public function processZip($content, $chapterId)
{
    // lấy path temp của máy có sẵn,    cái này là để phân biệt các folder với /, đặt tên file với prefix là zip???.zip
    $tempZipPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('zip_') . '.zip';
    //tạo dir để chứa file ảnh sau khi unzip
    $outputDir = 'uploads/chapters/' . $chapterId;
    //đảm bảo có đủ quyền RRW
    if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true);
    }
    // tạo 1 file tại $tempZip với ndung là content
    file_put_contents($tempZipPath, $content);

    $zip = new ZipArchive;
    //tạo mảng chứa ảnh 
    $images = [];
    $status = '';

    if ($zip->open($tempZipPath) === TRUE) {
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $fileName = $zip->getNameIndex($i);
    // lấy tiêu chuẩn file đúng là phần phía sau dấu . của tên file phải là jpg hoặc png và đem so sánh với tên file được duyệt qua
            if (preg_match('/\.(jpg|png)$/i', $fileName)) {
                $stream = $zip->getStream($fileName);
                // check nếu stream có dữ liệu
                if ($stream) {
                    //path để lưu ảnh
                    $imagePath = $outputDir . '/' . basename($fileName);
                    //lấy ra dữ liệu của stream và lưu vào path trên (ghi đè)
                    file_put_contents($imagePath, stream_get_contents($stream));
                    //hàm asset tạo 1 URL dẫn đến dir tĩnh cụ thể là public
                    //vd kq là /uploads/chapter/chapterId/img1.jpg thì tren web sẽ là webtruyen.test/uploads/...
                    $images[] = asset('uploads/chapters/' . $chapterId . '/' . basename($fileName));
                }
            }
        }
        $zip->close();
        if (!empty($images)) {
            $status = 'có zip';
        } else {
            $status = 'file rỗng';
        }
    } else {
        $status = 'lỗi file';
    }
    return [
        'images' => $images,
        'status' => $status,
    ];
}

public function show($chapterId)
{
    $chapter = Chapter::findOrFail($chapterId);
    //lấy ra tên truyện thông qua chapter 
    if ($chapter->truyen) {
        $truyen = $chapter->truyen;
    }
    $result = $this->processZip($chapter->content, $chapterId);
    return view('admin.chapter.view', [
        'chapter' => $chapter,
        'truyen' => $truyen,
        'images' => $result['images'],
        'status' => $result['status'],
    ]);
}

}