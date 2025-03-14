<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class KritsarController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('admin.kritiksaran.index', compact('feedbacks'));
    }
}
