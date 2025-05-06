<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentImage extends Model
{
    use HasFactory;

    protected $fillable = ['content_id', 'image_url'];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id'); // Pastikan menggunakan content_id
    }
}
