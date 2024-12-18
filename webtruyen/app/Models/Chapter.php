<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $table = 'chapters';

    protected $fillable = [
        'truyen_id',        // Khóa ngoại đến bảng truyen
        'chapter_number',   // Số thứ tự chương
        'ten_chapter',            // Tên chương
        'content',          // Nội dung chương
    ];
    public $timestamps = false; // Bỏ timestamps
    public function truyen()
    {
        return $this->belongsTo(Truyen::class); // Một chương thuộc về một truyện
    }
}