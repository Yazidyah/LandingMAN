<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visimisi = Content::where('category_id', 6)->get();
        $visi = Content::where('category_id', 6)->where('title', 'visi')->first();
        $misi = Content::where('category_id', 6)->where('title', 'misi')->first();
        return view('admin.visimisi.index', compact('visimisi', 'visi', 'misi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required',
            'misi' => 'required',
        ]);

        $userId = Auth::id();

        $visi = Content::updateOrCreate(
            ['category_id' => 6, 'title' => 'visi'],
            ['content' => $request->visi, 'user_id' => $userId, 'body' => $request->visi]
        );

        $misi = Content::updateOrCreate(
            ['category_id' => 6, 'title' => 'misi'],
            ['content' => $request->misi, 'user_id' => $userId, 'body' => $request->misi]
        );

        return redirect()->route('admin.visimisi.index')->with('success', 'Visi dan Misi berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $content = Content::findOrFail($id);
        $content->update([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'body' => $request->content,
        ]);

        return redirect()->route('admin.visimisi.index')->with('success', 'Konten berhasil diperbarui.');
    }
}
