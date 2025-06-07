<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\ContentImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BannerController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id'); // Set locale to Indonesian

        $contents = Content::where('category_id', 1)->with('images')->orderBy('created_at', 'desc')->get()->map(function ($content) {
            if ($content->images->isNotEmpty()) {
                $content->image_url = asset('storage/' . $content->images->first()->image_url);
            } else {
                $content->image_url = asset('storage/assets/content/default-image.jpg'); // Fallback image
            }
            return $content;
        });

        $news = Content::where('category_id', 3)->with('images')->orderBy('created_at', 'desc')->get()->map(function ($item) {
            $item->image_url = $item->images->first() ? asset('storage/' . $item->images->first()->image_url) : asset('storage/assets/content/default-image.jpg'); // Fallback image
            $item->formatted_date = Carbon::parse($item->created_at)->translatedFormat('l, d F Y'); // Add formatted date

            return $item;
        });

        return view('home', compact('contents', 'news'));
    }
}
