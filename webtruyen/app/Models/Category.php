<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories'; // Tên bảng trong database
    public $timestamps = false;

    protected $fillable = [
        'name', // Tên thể loại
    ];
    public function truyens()
{
    return $this->belongsToMany(
        Truyen::class, 
        'truyen_category',
        'category_id',
        'truyen_id'
    );
}
}