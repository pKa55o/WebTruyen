<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;
    // public $timestamps = false;

    protected $table = 'truyen'; // tên tabnle db
    protected $fillable = [
        'ten_truyen',
        'tac_gia',   
        'trang_thai',
        'mo_ta',    
        'thumbnail',
    ];
    //mqh 1-M với chapter
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'truyen_id', 'id');
    }
    public function categories()
{
    //mqh M-M giữa truyện với tag
    return $this->belongsToMany(
        Category::class,
        'truyen_category',
        'truyen_id',
        'category_id'
    );
}
    public function getCategoryNamesAttribute()
    {
        return $this->categories->pluck('name')->toArray(); //lấy tag list
    }
}