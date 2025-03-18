<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'unsur_id',
        'question_text',
        'question_order',
    ];

    public function unsur()
    {
        return $this->belongsTo(Unsur::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
