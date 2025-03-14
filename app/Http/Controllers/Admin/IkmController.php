<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class IkmController extends Controller
{
    public function index()
    {
        return view('admin.ikm.index');
    }
}
