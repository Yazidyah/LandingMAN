<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Content;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['category_name'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
