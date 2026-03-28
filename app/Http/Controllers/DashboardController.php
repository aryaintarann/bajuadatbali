<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        // Statistik utama
        $totalPesanan    = Order::count();
        $totalPendapatan = Order::where('status', 'paid')->sum('total');
        $pesananBaru     = Order::where('status', 'paid')
                                ->where(function ($q) {
                                    $q->whereNull('shipping_status')
                                      ->orWhere('shipping_status', 'diproses');
                                })
                                ->count();
        $totalPakaian    = DB::table('pakaian')->count();
        $stokHabis       = DB::table('pakaian')->where('stok_pakaian', '<=', 0)->count();
        $stokMenipis     = DB::table('pakaian')->where('stok_pakaian', '>', 0)->where('stok_pakaian', '<=', 5)->count();
        $refundPending   = Order::where('refund_status', 'requested')->count();

        // 5 pesanan terbaru
        $pesananTerbaru  = Order::with('items')->latest()->limit(5)->get();

        // Pendapatan per bulan (6 bulan terakhir)
        $pendapatanBulanan = Order::where('status', 'paid')
            ->selectRaw('MONTH(created_at) as bulan, YEAR(created_at) as tahun, SUM(total) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        return view('dashboard.index', compact(
            'title',
            'totalPesanan',
            'totalPendapatan',
            'pesananBaru',
            'totalPakaian',
            'stokHabis',
            'stokMenipis',
            'refundPending',
            'pesananTerbaru',
            'pendapatanBulanan'
        ));
    }
}
