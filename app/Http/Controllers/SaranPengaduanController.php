<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaranPengaduanController extends Controller
{
    public function index()
    {
        return view('guest.saranpengaduan.index');
    }
}
