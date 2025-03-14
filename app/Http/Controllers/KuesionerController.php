<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\LikertScale;

class KuesionerController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->query('step');
        $questions = Question::where('survey_id', 2)->get();
        $likertScales = LikertScale::all();
        return view('guest.survey_ppdb.index', compact('questions', 'step', 'likertScales'));
    }
}
