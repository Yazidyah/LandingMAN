<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikertScale extends Model
{
    use HasFactory;

    protected $table = 'likert_scale';
    protected $primaryKey = 'likert_value';
    public $timestamps = false;

    protected $fillable = [
        'likert_value',
        'description',
    ];
}
