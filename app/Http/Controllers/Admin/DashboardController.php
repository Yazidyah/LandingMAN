<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Simulasi data riwayat aktivitas - dalam implementasi nyata bisa menggunakan audit log
        $recentActivities = collect([
            [
                'id' => 1,
                'user_name' => 'Admin',
                'activity' => 'Menambahkan konten baru',
                'module' => 'contents',
                'action' => 'create',
                'route' => 'admin.contents.index',
                'time' => now()->subMinutes(5),
                'icon' => 'document-add',
                'color' => 'green'
            ],
            [
                'id' => 2,
                'user_name' => 'Editor',
                'activity' => 'Mengupdate FAQ',
                'module' => 'faq',
                'action' => 'update',
                'route' => 'admin.faq.index',
                'time' => now()->subMinutes(15),
                'icon' => 'pencil',
                'color' => 'yellow'
            ],
            [
                'id' => 3,
                'user_name' => 'Admin',
                'activity' => 'Menghapus banner lama',
                'module' => 'banner',
                'action' => 'delete',
                'route' => 'admin.banner.index',
                'time' => now()->subMinutes(30),
                'icon' => 'trash',
                'color' => 'red'
            ],
            [
                'id' => 4,
                'user_name' => 'Editor',
                'activity' => 'Menambahkan kategori baru',
                'module' => 'categories',
                'action' => 'create',
                'route' => 'admin.categories.index',
                'time' => now()->subHour(),
                'icon' => 'tag',
                'color' => 'blue'
            ],
            [
                'id' => 5,
                'user_name' => 'Admin',
                'activity' => 'Mengupdate data prestasi',
                'module' => 'prestasi',
                'action' => 'update',
                'route' => 'admin.prestasi.index',
                'time' => now()->subHours(2),
                'icon' => 'star',
                'color' => 'emerald'
            ],
            [
                'id' => 6,
                'user_name' => 'Editor',
                'activity' => 'Menambahkan survey baru',
                'module' => 'survey',
                'action' => 'create',
                'route' => 'admin.survey.index',
                'time' => now()->subHours(3),
                'icon' => 'chart-bar',
                'color' => 'pink'
            ],
        ])->take(5); // Ambil 5 aktivitas terbaru

        return view('admin.dashboard', compact('recentActivities'));
    }
}