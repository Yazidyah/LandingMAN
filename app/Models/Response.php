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

    protected $primaryKey = 'response_id'; // Update this line if the primary key is not 'id'
}
