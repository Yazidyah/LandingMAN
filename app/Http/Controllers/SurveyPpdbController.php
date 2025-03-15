<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class SurveyPpdbController extends Controller
{
    function index(Request $request)
    {
        $step = $request->query('step');
        $respondent_id = $request->query('respondent_id');

        $surveyId = 2;
        $questions = Question::where('survey_id', $surveyId)->get();

        return view('guest.survey_ppdb.index', compact('questions', 'step', 'respondent_id'));
    }
}
