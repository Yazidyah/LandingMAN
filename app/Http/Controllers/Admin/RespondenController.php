<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Respondent;
use Illuminate\Http\Request;

class RespondenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '') ?? '';
        $ageFilter = $request->get('age_filter', 'all') ?? 'all';
        $educationFilter = $request->get('education_filter', 'all') ?? 'all';
        $genderFilter = $request->get('gender_filter', 'all') ?? 'all';
        $jobFilter = $request->get('job_filter', 'all') ?? 'all';
        $perPage = (int) ($request->get('per_page', 5) ?? 5);
        $startDate = $request->get('start_date', null);
        $endDate = $request->get('end_date', null);

        $respondents = $this->getFilteredRespondents($search, $ageFilter, $educationFilter, $genderFilter, $jobFilter, $perPage, $startDate, $endDate);

        return view('admin.responden.index', compact('respondents'));
    }

    private function getFilteredRespondents(string $search, string $ageFilter, string $educationFilter, string $genderFilter, string $jobFilter, int $perPage, ?string $startDate, ?string $endDate)
    {
        return Respondent::when($search !== '', function ($query) use ($search) {
            $query->where('nama_lengkap', 'like', "%$search%");
        })->when($ageFilter !== 'all', function ($query) use ($ageFilter) {
            switch ($ageFilter) {
                case 'anak-anak':
                    $query->whereBetween('usia', [0, 12]);
                    break;
                case 'remaja':
                    $query->whereBetween('usia', [13, 17]);
                    break;
                case 'dewasa':
                    $query->whereBetween('usia', [18, 59]);
                    break;
                case 'lansia':
                    $query->where('usia', '>=', 60);
                    break;
            }
        })->when($educationFilter !== 'all', function ($query) use ($educationFilter) {
            $query->where('pendidikan', $educationFilter);
        })->when($genderFilter !== 'all', function ($query) use ($genderFilter) {
            $query->where('jenis_kelamin', $genderFilter);
        })->when($jobFilter !== 'all', function ($query) use ($jobFilter) {
            $query->where('pekerjaan', $jobFilter);
        })->when($startDate, function ($query) use ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        })->when($endDate, function ($query) use ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        })->paginate($perPage);
    }
}
