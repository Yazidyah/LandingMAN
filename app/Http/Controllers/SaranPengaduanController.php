<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Respondent;
use App\Models\Response;
use App\Models\ResponseDetail;
use App\Models\Feedback;

class SaranPengaduanController extends Controller
{
    public function index()
    {
        $questions = Question::where('survey_id', 1)->get();
        return view('guest.saranpengaduan.index', compact('questions'));
    }
    function store(Request $request)
    {
        $respondentData = $request->only(['nama_lengkap', 'jenis_kelamin', 'usia', 'pendidikan', 'pekerjaan']);
        $respondentData['nama_lengkap'] = strtolower($respondentData['nama_lengkap']);
        
        // Check if the respondent already exists
        $respondent = Respondent::where($respondentData)->first();
        if (!$respondent) {
            $respondent = $this->createRespondent($respondentData);
        }

        // Check if the respondent already has a response for the survey
        $response = Response::where('respondent_id', $respondent->id)
                            ->where('survey_id', 1)
                            ->first();

        if (!$response) {
            $response = $this->createResponse($respondent->id);
        }

        // Update or create response details
        $this->createOrUpdateResponseDetails(
            $request->except(['_token', 'nama_lengkap', 'jenis_kelamin', 'usia', 'pendidikan', 'pekerjaan', 'kritik', 'saran']),
            $response->id
        );

        // Save kritik and saran
        Feedback::create([
            'survey_id' => 1,
            'respondent_id' => $respondent->id,
            'kritik' => $request->kritik,
            'saran' => $request->saran,
        ]);

        return redirect()->route('ppdb.survey')->with('success', 'Survey submitted successfully.');
    }

    private function createRespondent(array $data)
    {
        return Respondent::create($data);
    }

    private function createResponse(int $respondentId)
    {
        return Response::create([
            'survey_id' => 1,
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

