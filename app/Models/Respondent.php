<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    use HasFactory;

    protected $table = 'respondents';

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'usia',
        'pendidikan',
        'pekerjaan',
    ];
}
