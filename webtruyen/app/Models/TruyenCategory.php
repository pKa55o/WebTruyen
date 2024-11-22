<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruyenCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'truyen_category';

    protected $fillable = [
        'truyen_id',   // ID truyện
        'category_id', // ID thể loại
    ];
}