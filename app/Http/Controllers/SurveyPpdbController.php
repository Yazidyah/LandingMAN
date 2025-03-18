<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Respondent;
use App\Models\Response;
use App\Models\ResponseDetail;

class SurveyPpdbController extends Controller
{
    function index()
    {
        $questions = Question::where('survey_id', 2)->get();
        return view('guest.survey_ppdb.index', compact('questions'));
    }

    function store(Request $request)
    {
        $respondentData = $request->only(['nama_lengkap', 'jenis_kelamin', 'usia', 'pendidikan', 'pekerjaan']);
        
        // Check if the respondent already exists
        $respondent = Respondent::where($respondentData)->first();
        if (!$respondent) {
            $respondent = $this->createRespondent($respondentData);
        }

        // Check if the respondent already has a response for the survey
        $response = Response::where('respondent_id', $respondent->id)
                            ->where('survey_id', 2)
                            ->first();

        if (!$response) {
            $response = $this->createResponse($respondent->id);
        }

        // Update or create response details
        $this->createOrUpdateResponseDetails(
            $request->except(['_token', 'nama_lengkap', 'jenis_kelamin', 'usia', 'pendidikan', 'pekerjaan']),
            $response->id
        );

        return redirect()->route('ppdb.survey')->with('success', 'Survey submitted successfully.');
    }

    private function createRespondent(array $data)
    {
        return Respondent::create($data);
    }

    private function createResponse(int $respondentId)
    {
        return Response::create([
            'survey_id' => 2,
            'respondent_id' => $respondentId,
            'response_date' => now(),
        ]);
    }

    private function createOrUpdateResponseDetails(array $responses, int $responseId)
    {
        foreach ($responses as $key => $value) {
            $questionId = str_replace('question_', '', $key);

            // Update if the response detail exists, otherwise create a new one
            ResponseDetail::updateOrCreate(
                ['response_id' => $responseId, 'question_id' => $questionId],
                ['likert_value' => $value]
            );
        }
    }
}
