<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarah = Content::where('category_id', 2)->where('title', 'sejarah')->first();
        return view('admin.sejarah.index', compact('sejarah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sejarah' => 'required',
        ]);

        $userId = Auth::id();

        $sejarah = Content::updateOrCreate(
            ['category_id' => 2, 'title' => 'sejarah'],
            [
                'content' => $request->sejarah,
                'user_id' => $userId,
                'body' => $request->sejarah,
                'slug' => 'sejarah'
            ]
        );

        // Log the creation/update activity
        Log::info('Sejarah Created/Updated', [
            'user_id' => $userId,
            'username' => Auth::user()->name,
            'action' => 'Create/Update',
            'sejarah' => $sejarah->content,
        ]);

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil disimpan.');
    }
}
