<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;
    protected $table = 'truyen'; //tên table db
    protected $fillable = [
        'ten_truyen',
        'tac_gia',   
        'trang_thai',
        'mo_ta',    
        'thumbnail',
    ];
    //mqh 1 truyen - N chapter
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'truyen_id', 'id');
    }
    //mqh N truyen - N tag
    public function categories()
{
    return $this->belongsToMany(
        Category::class,
        'truyen_category',
        'truyen_id',
        'category_id'
    );
}
    public function getCategoryNamesAttribute()
    {
        return $this->categories->pluck('name')->toArray();
    }
}