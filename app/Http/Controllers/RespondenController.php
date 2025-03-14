<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respondent;

class RespondenController extends Controller
{
    public function index(Request $request)
    {
        $step = $request->query('step');
        return view('guest.survey_ppdb.index', compact('step'));
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

        Respondent::create($validatedData);

        return redirect()->route('ppdb.survey', ['step' => 1])->with('success', 'Data has been submitted successfully.');
    }
}
