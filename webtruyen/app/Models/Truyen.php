<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'truyen'; // Tên bảng trong database

    /**
     * Các cột có thể điền giá trị (mass assignable).
     */
    protected $fillable = [
        'ten_truyen',   // Tên truyện
        'tac_gia',      // Tác giả
        'trang_thai',   // Trạng thái
        'mo_ta',        // Mô tả
        'thumbnail',    // Đường dẫn ảnh thumbnail
    ];

    /**
     * Quan hệ 1-N với bảng chapters (một truyện có nhiều chapter).
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'truyen_id', 'id');
    }

    /**
     * Quan hệ N-N với bảng category thông qua bảng liên kết truyen_category.
     */
    public function categories()
{
    return $this->belongsToMany(
        Category::class,
        'truyen_category',
        'truyen_id',
        'category_id'
    );
}

    /**
     * Accessor để hiển thị danh sách thể loại đã chọn.
     */
    public function getCategoryNamesAttribute()
    {
        return $this->categories->pluck('name')->toArray(); // Lấy danh sách tên thể loại
    }
}