<?php

namespace App\Http\Controllers;
use App\Models\Truyen;

class IndexController extends Controller
{
    public function index()
    {
        $truyens = Truyen::all();
    return view('pages.home', compact('truyens'));
    }
    public function manga()
    {
    return view('pages.manga');
    }
    public function manhwa()
    {
    return view('pages.manhwa');
    }
    public function manhua()
    {
    return view('pages.manhua');
    }
    public function search()
    {
    return view('pages.search');
    }
    public function in4truyen($truyen_id)
{
    $truyen = Truyen::with([
        'categories',
        'chapters' => function ($query) {
            $query->orderBy('updated_at', 'desc');
        }
    ])->findOrFail($truyen_id);

    // Lấy chương đầu tiên hoặc null nếu không có
    $chapter = $truyen->chapters->first();

    return view('pages.info', [
        'truyen' => $truyen,
        'chapter' => $chapter, // Truyền biến $chapter vào view
    ]);
}
    public function giaodien3()
    {
    return view('pages.giaodien3');
    }
}