<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $table = 'responses';

    protected $fillable = [
        'survey_id',
        'respondent_id',
        'response_date',
    ];

    public function respondent()
    {
        return $this->belongsTo(Respondent::class, 'respondent_id');
    }
}
