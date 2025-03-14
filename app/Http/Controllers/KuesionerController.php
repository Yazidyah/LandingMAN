<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\LikertScale;
use App\Models\Response;
use App\Models\ResponseDetail;

class KuesionerController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->query('step');
        $questions = Question::where('survey_id', 2)->get();
        $likertScales = LikertScale::all();
        $respondent_id = $request->query('respondent_id');
        return view('guest.survey_ppdb.index', compact('questions', 'step', 'likertScales', 'respondent_id'));
    }

    public function store(Request $request)
    {
        $response = Response::create([
            'survey_id' => 2,
            'respondent_id' => $request->input('respondent_id'),
            'response_date' => now(),
        ]);

        foreach ($request->input() as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $questionId = str_replace('question_', '', $key);
                ResponseDetail::create([
                    'response_id' => $response->id,
                    'question_id' => $questionId,
                    'likert_value' => $value,
                ]);
            }
        }

        return redirect()->route('survey.index', ['step' => 2]);
    }
}
