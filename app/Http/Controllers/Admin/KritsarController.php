<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Survey;
use Illuminate\Http\Request;

class KritsarController extends Controller
{
    public function index(Request $request)
    {
        $surveyId = $request->input('survey_id');
        $surveys = Survey::all();

        $feedbacks = Feedback::with(['survey', 'respondent'])
            ->when($surveyId, function ($query, $surveyId) {
                return $query->where('survey_id', $surveyId);
            })
            ->get();

        return view('admin.kritiksaran.index', compact('feedbacks', 'surveys', 'surveyId'));
    }
}
