<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Achievement;
use Carbon\Carbon;

class GuestController extends Controller
{
    public function profilsekolah()
    {
        return view('guest.profilsekolah');
    }

    /**
     * Helper method to get the image URL with fallback to default image.
     *
     * @param  \Illuminate\Database\Eloquent\Collection|null  $images
     * @return string
     */
    private function getImageUrl($images)
    {
        return $images && $images->isNotEmpty()
            ? asset('storage/' . $images->first()->image_url)
            : asset('storage/assets/content/default-image.jpg');
    }

    // category_id = 2
    public function sejarah()
    {
        $sejarah = Content::where('category_id', 2)->where('title', 'sejarah')->first();
        return view('guest.sejarah', compact('sejarah'));
    }

    public function visimisi()
    {
        $visimisi = Content::where('category_id', 2)->get();
        $visi = Content::where('category_id', 2)->where('title', 'visi')->first();
        $misi = Content::where('category_id', 2)->where('title', 'misi')->first();
        return view('guest.visimisi', compact('visimisi', 'visi', 'misi'));
    }

    // category_id = 3
    public function news(Request $request)
    {
        $query = Content::where('category_id', 3)->with('images');
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', '%' . $search . '%');
        }
        $news = $query->get()->map(function ($item) {
            $item->image_url = $this->getImageUrl($item->images); 
            \Carbon\Carbon::setLocale('id'); 
            $item->formatted_date = \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y');
            return $item;
        });
        return view('guest.news', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = Content::with('images')
            ->where('slug', $slug)
            ->whereNotIn('category_id', [1, 2]) // Kecualikan kategori 1 dan 2
            ->firstOrFail();
        Carbon::setLocale('id');
        $news->image_url = $this->getImageUrl($news->images); 
        $news->formatted_date = Carbon::parse($news->created_at)->translatedFormat('l, d F Y');
        return view('guest.newsDetail', compact('news'));
    }

    // category_id = 4
    public function agenda(Request $request)
    {
        $query = Content::where('category_id', 4)->with('images');
        if ($request->has('search') && $request->search) {
            $search = strtolower($request->search);
            $query->where('slug', 'like', '%' . $search . '%');
        }
        $news = $query->get()->map(function ($item) {
            $item->image_url = $this->getImageUrl($item->images); 
            return $item;
        });

        // Set locale ke Indonesia untuk nama bulan
        \Carbon\Carbon::setLocale('id');

        // Kelompokkan berdasarkan bulan-tahun (dalam bahasa Indonesia)
        $groupedNews = $news->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->translatedFormat('F Y');
        });

        return view('guest.agenda', [
            'groupedNews' => $groupedNews,
            'search' => $request->search ?? ''
        ]);
    }

    // category_id = 5
    public function fasilitas(Request $request)
    {
        $query = Content::where('category_id', 5)->with('images');
        if ($request->has('search') && $request->search) {
            $search = strtolower($request->search);
            $query->where('slug', 'like', '%' . $search . '%');
        }
        $news = $query->get()->map(function ($item) {
            $item->image_url = $this->getImageUrl($item->images); 
            return $item;
        });
        return view('guest.fasilitas', [
            'news' => $news,
            'search' => $request->search ?? ''
        ]);
    }

    // Lain-lain
    public function prestasi()
    {
        $prestasi = Achievement::orderBy('created_at', 'desc')->get();
        return view('guest.prestasi', compact('prestasi'));
    }

    public function faq(Request $request)
    {
        $query = Faq::query();
        if ($request->has('search') && $request->search) {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(question) LIKE ?', ['%' . $search . '%']);
        }
        $news = $query->get();
        return view('guest.faq', [
            'news' => $news,
            'search' => $request->search ?? ''
        ]);
    }

    public function survey()
    {
        return view('guest.survey');
    }

    public function publikasi()
    {
        return view('guest.publikasi');
    }
}
