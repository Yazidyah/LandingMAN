<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Http\Controllers\Controller;
use App\Models\Faq;
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

    public function agenda()
    {
        $news = Content::where('category_id', 3)->with('images')->get()->map(function ($item) {
            $item->image_url = $this->getImageUrl($item->images); // Use helper method
            return $item;
        });
        return view('guest.agenda', compact('news'));
    }

    public function prestasi()
    {
        $news = Content::where('category_id', 6)->with('images')->get()->map(function ($item) {
            $item->image_url = $this->getImageUrl($item->images); // Use helper method
            return $item;
        });
        return view('guest.prestasi',compact('news'));
    }

    public function faq()
    {
        $news = Faq::all();
        return view('guest.faq', compact('news'));
    }

    public function fasilitas()
    {
        $news = Content::where('category_id', 4)->with('images')->get()->map(function ($item) {
            $item->image_url = $this->getImageUrl($item->images); // Use helper method
            return $item;
        });
        return view('guest.fasilitas',compact('news'));
    }

    public function news()
    {
        $news = Content::where('category_id', 5)->with('images')->get()->map(function ($item) {
            $item->image_url = $this->getImageUrl($item->images); // Use helper method
            Carbon::setLocale('id'); // Set locale to Indonesian
            $item->formatted_date = Carbon::parse($item->created_at)->translatedFormat('l, d F Y');
            return $item;
        });
        return view('guest.news', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = Content::with('images')->where('slug', $slug)->firstOrFail();
        Carbon::setLocale('id'); // Set locale to Indonesian
        $news->image_url = $this->getImageUrl($news->images); // Use helper method
        $news->formatted_date = Carbon::parse($news->created_at)->translatedFormat('l, d F Y');
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
        $visimisi = Content::where('category_id', 2)->get();
        $visi = Content::where('category_id', 2)->where('title', 'visi')->first();
        $misi = Content::where('category_id', 2)->where('title', 'misi')->first();
        return view('guest.visimisi', compact('visimisi', 'visi', 'misi'));
    }

    public function publikasi()
    {
        return view('guest.publikasi');
    }
}
