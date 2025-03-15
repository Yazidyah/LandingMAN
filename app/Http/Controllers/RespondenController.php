<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respondent;
use App\Models\Question;

class RespondenController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->input('step', 1);
        return view('guest.survey_ppdb.index', compact('step'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'usia' => 'required|integer',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
        ]);

        $respondent = Respondent::create($validatedData);

        // Store respondent_id in session
        $request->session()->put('respondent_id', $respondent->id);

        // Debugging: Check if respondent_id is stored in session
        if ($request->session()->has('respondent_id')) {
            return redirect()->route('ppdb.survey', ['step' => 2]);
        } else {
            return redirect()->route('ppdb.survey', ['step' => 1])->withErrors('Failed to store respondent_id in session.');
        }
    }
}
