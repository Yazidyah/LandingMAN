<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Respondent;
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    public function index()
    {
        $respondents = Respondent::all();
        return view('admin.responden.index', compact('respondents'));
    }
}
