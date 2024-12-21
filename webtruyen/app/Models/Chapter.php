<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $table = 'chapters';

    protected $fillable = [
        'truyen_id',
        'chapter_number',
        'ten_chapter',
        'content',
    ];
    public function truyen()
    {
        return $this->belongsTo(Truyen::class);
    }
}