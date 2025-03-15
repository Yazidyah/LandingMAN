<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseDetail;

class KuesionerController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->query('step');
        $questionId = $request->query('question');
        $respondent_id = $request->query('respondent_id');

        $surveyId = 2;
        $firstQuestion = Question::where('survey_id', $surveyId)->first();

        if ($firstQuestion && !$questionId) {
            $questionId = $firstQuestion->question_id;
        }

        if ($questionId) {
            $questions = Question::where('survey_id', $surveyId)->where('question_id', $questionId)->get();
        } else {
            $questions = Question::where('survey_id', $surveyId)->get();
        }

        return view('guest.survey_ppdb.kuesioner', compact('questions', 'step', 'respondent_id'));
    }

    public function store(Request $request)
    {
        $respondent_id = $request->input('respondent_id');

        $response = Response::create([
            'survey_id' => 2,
            'respondent_id' => $respondent_id,
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

        return redirect()->route('guest.survey_ppdb.index', ['step' => 2]);
    }
}
