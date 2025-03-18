<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseDetail extends Model
{
    use HasFactory;

    protected $table = 'response_details';

    protected $fillable = [
        'response_id',
        'question_id',
        'likert_value',
    ];

    public $timestamps = true;

    public function response()
    {
        return $this->belongsTo(Response::class, 'response_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
