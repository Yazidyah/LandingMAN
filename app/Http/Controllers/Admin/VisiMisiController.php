<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visimisi = Content::where('category_id', 2)->get();
        $visi = Content::where('category_id', 2)->where('title', 'visi')->first();
        $misi = Content::where('category_id', 2)->where('title', 'misi')->first();
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
            ['category_id' => 2, 'title' => 'visi'],
            ['content' => $request->visi, 'user_id' => $userId, 'body' => $request->visi, 'slug' => 'visi']
        );

        $misi = Content::updateOrCreate(
            ['category_id' => 2, 'title' => 'misi'],
            ['content' => $request->misi, 'user_id' => $userId, 'body' => $request->misi, 'slug' => 'misi']
        );

        // Log the creation activity
        Log::info('Visi & Misi Created/Updated', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Create/Update',
            'visi' => $visi->content,
            'misi' => $misi->content,
        ]);

        return redirect()->route('admin.visimisi.index')->with('success', 'Visi dan Misi berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $content = Content::findOrFail($id);
        $slug = $content->title === 'visi' ? 'visi' : ($content->title === 'misi' ? 'misi' : Str::slug($content->title));
        $content->update([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'body' => $request->content,
            'slug' => $slug,
        ]);

        // Log the update activity
        Log::info('Visi & Misi Updated', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->name,
            'action' => 'Update',
            'content_id' => $content->id,
            'content' => $content->content,
        ]);

        return redirect()->route('admin.visimisi.index')->with('success', 'Konten berhasil diperbarui.');
    }
}
