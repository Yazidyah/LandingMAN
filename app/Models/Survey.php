<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_name',
        'description',
        'start_date',
        'end_date',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
