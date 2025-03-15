<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Respondent;
use App\Models\Response;
use App\Models\ResponseDetail;

class SurveyPpdbController extends Controller
{
    function index(Request $request)
    {
        $step = $request->query('step', 1);
        $respondent_id = $request->query('respondent_id');
        $questions = ($step == 2) ? Question::where('survey_id', 2)->get() : [];

        return view('guest.survey_ppdb.index', compact('step', 'respondent_id', 'questions'));
    }

    public function storeRespondent(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'usia' => 'required|integer',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
        ]);

        $respondent = Respondent::create($validatedData);

        return redirect()->route('ppdb.survey', ['step' => 2, 'respondent_id' => $respondent->id]);
    }

    public function storeResponse(Request $request)
    {
        $respondent_id = $request->query('respondent_id');

        // Validate the responses
        $validatedData = $request->validate([
            'question_*' => 'required|in:1,2,3,4,5',
        ]);

        // Create a new response
        $response = Response::create([
            'survey_id' => 2,
            'respondent_id' => $respondent_id,
            'response_date' => now(),
        ]);

        // Save each response detail
        foreach ($validatedData as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $question_id = str_replace('question_', '', $key);
                ResponseDetail::create([
                    'response_id' => $response->response_id,
                    'question_id' => $question_id,
                    'likert_value' => $value,
                ]);
            }
        }

        return redirect()->route('ppdb.survey', ['step' => 3])->with('success', 'Thank you for your responses!');
    }
}
