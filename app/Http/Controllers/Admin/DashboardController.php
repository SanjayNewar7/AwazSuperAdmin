<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Issue;
use App\Models\Post;
use App\Models\DistrictData;
use DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get dashboard statistics
        $stats = [
            'total_issues' => Issue::count(),
            'total_users' => User::count(),
            'verified_users' => User::where('is_verified', 1)->count(),
            'total_comments' => DB::table('issue_comments')->count(),
        ];

        // Get recent issues
        $recentIssues = Issue::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get districts for filter

       // Selected filters
    $selectedDistrict = $request->input('district');
    log::info('Selected District: ' . $selectedDistrict);
    log::info('request : ' . json_encode($request->all()));

    // Fetch districts and regions
    $districts = DistrictData::getDistricts();
    Log::info('Districts fetched: ' . json_encode($districts));

    $regions = $selectedDistrict ? DistrictData::getRegions($selectedDistrict) : [];
    Log::info('Regions fetched: ' . json_encode($regions));

        // Get issue types data
        $issueTypes = Issue::select('report_type', DB::raw('count(*) as count'))
            ->groupBy('report_type')
            ->get()
            ->pluck('count', 'report_type')
            ->toArray();
        Log::info('Issue types data: ' . json_encode($issueTypes));

        // Get issue trends data
        $issueTrends = Issue::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        // Define report types
        $reportTypes = [
            'All Issues', 'Water Supply', 'Electricity', 'Roads', 'Waste',
            'Transport', 'Street Lights', 'Drainage', 'Pollution', 'Robbery',
            'Community', 'Healthcare', 'Education', 'Environmental', 'Traffic',
            'Noise', 'Government', 'Parks', 'Construction', 'Animal', 'Fire', 'Others'
        ];

        return view('admin.dashboard', compact(
            'stats',
            'recentIssues',
            'districts',
            'issueTypes',
            'issueTrends',
            'reportTypes'
        ));
    }

    public function getAnalytics(Request $request)
    {
        $filters = $request->validate([
            'district' => 'nullable|string',
            'region' => 'nullable|string',
            'ward' => 'nullable|integer',
            'report_type' => 'nullable|string',
            'date_range' => 'nullable|string',
        ]);

        // Build query based on filters
        $query = Issue::query();

        if (!empty($filters['district'])) {
            $query->where('district', $filters['district']);
        }

        if (!empty($filters['region'])) {
            $query->where('area_name', $filters['region']);
        }

        if (!empty($filters['ward'])) {
            $query->where('ward', $filters['ward']);
        }

        if (!empty($filters['report_type']) && $filters['report_type'] !== 'All Issues') {
            $query->where('report_type', $filters['report_type']);
        }

        // Apply date range filter
        if (!empty($filters['date_range'])) {
            $days = (int)$filters['date_range'];
            $query->where('created_at', '>=', now()->subDays($days));
        }

        // Issue types chart data
        $issueTypes = $query->clone()
            ->select('report_type', DB::raw('count(*) as count'))
            ->groupBy('report_type')
            ->get()
            ->pluck('count', 'report_type');

        // Issue trends data
        $issueTrends = $query->clone()
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // District-wise issues
        $districtIssues = $query->clone()
            ->select('district', DB::raw('count(*) as count'))
            ->groupBy('district')
            ->get()
            ->pluck('count', 'district');

        return response()->json([
            'issue_types' => $issueTypes,
            'issue_trends' => $issueTrends,
            'district_issues' => $districtIssues,
        ]);
    }

  public function getRegions(Request $request)
{
    $district = $request->input('district');
    Log::info('getRegions called with district: ' . $district); // Debug
    $regions = DistrictData::getRegions($district);
    Log::info('Regions returned: ' . json_encode($regions)); // Debug
    return response()->json($regions);
}
    public function getWards(Request $request)
    {
        $district = $request->input('district');
        $region = $request->input('region');
        $wards = DistrictData::getWards($district, $region);

        return response()->json($wards);
    }
}
