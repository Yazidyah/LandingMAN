<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'survey_id',
        'respondent_id',
        'kritik',
        'saran',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function respondent()
    {
        return $this->belongsTo(Respondent::class);
    }
}
