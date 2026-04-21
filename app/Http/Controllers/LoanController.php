<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    // Menampilkan form peminjaman
    public function create()
    {
        $items = Item::where('stock', '>', 0)->get();
        return view('admin.loans.create', compact('items'));
    }

    // Logika Pengembalian Barang
    public function returnItem($id)
    {
        $loan = Loan::findOrFail($id);

        // Keamanan: Jika bukan admin DAN bukan pemilik pinjaman, blokir!
        if (auth()->user()->role !== 'admin' && $loan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak diizinkan melakukan aksi ini.');
        }

        DB::transaction(function () use ($loan) {
            $loan->update([
                'status' => 'returned',
                'return_date' => now(), // Mencatat tanggal aktual saat barang dikembalikan
            ]);

            $loan->item->increment('stock', $loan->quantity);
        });

        return redirect()->back()->with('success', 'Barang berhasil dikembalikan tepat waktu.');
    }

    public function index()
    {
        $loans = (auth()->user()->role === 'admin')
            ? Loan::with(['user', 'item'])->latest()->get()
            : Loan::with(['item'])->where('user_id', auth()->id())->latest()->get();
        return view('admin.loans.index', compact('loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id'     => 'required|exists:items,id',
            'quantity'    => 'required|integer|min:1',
            'return_date' => 'required|date|after_or_equal:today', // Validasi tanggal
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($item->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        DB::transaction(function () use ($request, $item) {
            Loan::create([
                'user_id'     => auth()->id(),
                'item_id'     => $request->item_id,
                'quantity'    => $request->quantity,
                'loan_date'   => now(),
                'return_date' => $request->return_date, // Simpan tanggal kembali
                'status'      => 'borrowed',
            ]);

            $item->decrement('stock', $request->quantity);
        });

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dicatat.');
    }
}
