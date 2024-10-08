<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'content',
        'published_at',
        'author_id',
        'tags',
    ];

    public function author()
    {
        return $this->belongsTo(Users::class, 'author_id');
    }
}
