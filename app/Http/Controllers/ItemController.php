<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua barang.
     */
    public function index()
    {
        $items = Item::latest()->get();
        return view('admin.items.index', compact('items'));
    }

    /**
     * Menampilkan form tambah barang.
     */
    public function create()
    {
        return view('admin.items.create');
    }

    /**
     * Menyimpan barang baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'code'  => 'required|string|unique:items,code',
            'stock' => 'required|integer|min:0',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit barang.
     */
    public function edit(Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    /**
     * Memperbarui data barang.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'code'  => 'required|string|unique:items,code,' . $item->id,
            'stock' => 'required|integer|min:0',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Menghapus barang.
     */
    public function destroy(Item $item)
    {
        // Cek jika barang sedang dipinjam (opsional)
        if ($item->loans()->where('status', 'borrowed')->exists()) {
            return redirect()->back()->with('error', 'Barang tidak bisa dihapus karena sedang dipinjam.');
        }

        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
