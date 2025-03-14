<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $primaryKey = 'question_id';

    protected $fillable = [
        'element_id',
        'question_text',
        'question_order',
    ];

    public function element()
    {
        return $this->belongsTo(Element::class);
    }
}
