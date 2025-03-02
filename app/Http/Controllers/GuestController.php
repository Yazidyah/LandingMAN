<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class GuestController extends Controller
{
    public function profilsekolah()
    {
        return view('guest.profilsekolah');
    }

    public function agenda()
    {
        return view('guest.agenda');
    }

    public function prestasi()
    {
        return view('guest.prestasi');
    }

    public function faq()
    {
        return view('guest.faq');
    }

    public function fasilitas()
    {
        return view('guest.fasilitas');
    }

    public function news()
    {
        $news = Content::where('category_id', 5)->with('images')->get()->map(function ($item) {
            $item->image_url = $item->images->first() ? asset('storage/' . $item->images->first()->image_url) : asset('storage/assets/content/default-image.jpg');
            return $item;
        });
        return view('guest.news', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = Content::with('images')->where('slug', $slug)->firstOrFail();
        return view('guest.newsDetail', compact('news'));
    }

    public function saranpengaduan()
    {
        return view('guest.saranpengaduan');
    }

    public function sejarah()
    {
        return view('guest.sejarah');
    }

    public function visimisi()
    {
        return view('guest.visimisi');
    }

    public function publikasi()
    {
        return view('guest.publikasi');
    }
}
