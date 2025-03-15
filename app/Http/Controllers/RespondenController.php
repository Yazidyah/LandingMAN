<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respondent;
use App\Models\Question;

class RespondenController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->query('step');
        $respondent_id = $request->query('respondent_id');
        return view('guest.survey_ppdb.responden', compact('step', 'respondent_id'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'usia' => 'required|integer',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        $respondent = Respondent::create($validatedData);

        // Fetch the first question of survey_id = 2
        $firstQuestion = Question::where('survey_id', 2)->first();

        return redirect()->route('guest.survey_ppdb.index', [
            'step' => 2,
            'respondent_id' => $respondent->id
        ]);
    }
}
