<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Dasar
        $total_items = Item::sum('stock');
        $active_loans = Loan::where('status', 'borrowed')->count();
        $total_users = User::count();

        // Hitung persentase barang keluar vs stok total
        $total_all = $total_items + Loan::where('status', 'borrowed')->sum('quantity');
        $utilization = $total_all > 0 ? round((Loan::where('status', 'borrowed')->sum('quantity') / $total_all) * 100, 1) : 0;

        // Data Grafik 6 Bulan Terakhir
        $chartData = Loan::select(
            DB::    raw('COUNT(id) as total'),
            DB::raw("DATE_FORMAT(created_at, '%M') as month")
        )
            ->groupBy('month')
            ->orderBy('created_at', 'ASC')
            ->take(6)
            ->get();

        return view('admin.dashboard', [
            'total_items'    => $total_items,
            'total_types'    => Item::count(),
            'active_loans'   => $active_loans,
            'total_users'    => $total_users,
            'utilization'    => $utilization,
            'chart_labels'   => $chartData->pluck('month'),
            'chart_values'   => $chartData->pluck('total'),
            'recent_loans'   => Loan::with(['item', 'user'])->latest()->take(15)->get()
        ]);
    }
}
