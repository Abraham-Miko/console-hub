<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitPeralatan;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $startDate = Carbon::now()->subMonths(6)->startOfMonth();

        $monthlyData = Pemesanan::select(
                DB::raw('COUNT(id) as count'),
                DB::raw("DATE_FORMAT(tgl_mulai, '%Y-%m') as month_year")
            )
            ->where('status_pemesanan', 'selesai')
            ->where('tgl_mulai', '>=', $startDate)
            ->groupBy('month_year')
            ->orderBy('month_year')
            ->get();

        $months = [];
        $totals = [];

        foreach ($monthlyData as $data) {
            $months[] = Carbon::createFromFormat('Y-m', $data->month_year)->format('M Y');
            $totals[] = $data->count;
        }
        $collectTotals = collect($totals);
        $sumTotals = $collectTotals->sum();
        // dd($sumTotals);
         $stats = [
            'totalUnitPeralatan'    => UnitPeralatan::count(),
            'totalPeralatanTersedia'=> UnitPeralatan::where('status_peralatan', 'tersedia')->count(),
            'totalPeralatanDirental'=> UnitPeralatan::where('status_peralatan', 'dirental')->count(),
            'totalPeralatanDipesan' => UnitPeralatan::where('status_peralatan', 'dipesan')->count()
        ];

        return view('dashboard', compact('stats', 'months', 'totals', 'sumTotals'));
    }

}
