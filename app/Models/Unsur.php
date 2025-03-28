<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unsur extends Model
{
    use HasFactory;

    protected $table = 'unsur';
    protected $fillable = [
        'unsur_name',
        'description',
    ];
}
