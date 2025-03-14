<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $primaryKey = 'element_id';

    protected $fillable = [
        'element_name',
        'description',
    ];
}
