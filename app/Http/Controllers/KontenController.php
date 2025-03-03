<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KontenController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Content::with(['category', 'images'])
            ->whereNotIn('category_id', [1, 2]);

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $contents = $query->get()->map(function ($content) {
            if ($content->images->isNotEmpty()) {
                $content->image_url = asset('storage/' . $content->images->first()->image_url);
            }
            // Assign category color based on category_id
            switch ($content->category->id) {
                case 1:
                    $content->category_color = 'bg-yellow-300 text-grey-800';
                    break;
                case 2:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 3:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 4:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 5:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 6:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 7:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 8:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 9:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                case 10:
                    $content->category_color = 'bg-blue-300 text-white-800';
                    break;
                default:
                    $content->category_color = 'bg-gray-300 text-white-800';
                    break;
            }
            return $content;
        });

        return view('admin.contents.index', compact('contents', 'categories'));
    }

    public function deleteImage($id)
    {
        try {
            $image = ContentImage::findOrFail($id);
            Storage::delete('public/' . $image->image_url);
            $image->delete();

            Log::info('Image deleted successfully: ' . $id);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error deleting image: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
