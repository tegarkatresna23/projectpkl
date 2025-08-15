<?php

namespace App\Http\Controllers;

use App\Models\StockLog;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StockLogController extends Controller
{
    /**
     * Tampilkan semua log stok
     */
    public function index(): View
    {
        $stockLogs = StockLog::with('product')->latest('created_at')->paginate(10);
        return view('stock_logs.index', compact('stockLogs'));
    }

    /**
     * Form tambah log stok
     */
    public function create()
{
    $products = Product::all(); // ambil semua produk
    return view('stock_logs.create', compact('products'));
}


    /**
     * Simpan log stok
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id'  => 'required|exists:products,id',
            'change_type' => 'required|in:in,out',
            'quantity'    => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        StockLog::create([
            'product_id'  => $request->product_id,
            'change_type' => $request->change_type,
            'quantity'    => $request->quantity,
            'description' => $request->description,
            'created_at'  => now()
        ]);

        return redirect()->route('stock_logs.index')->with('success', 'Log stok berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail log stok
     */
    public function show($id): View
    {
        $stockLog = StockLog::with('product')->findOrFail($id);
        return view('stock_logs.show', compact('stockLog'));
    }

    /**
     * Form edit log stok
     */
    public function edit($id): View
    {
        $stockLog = StockLog::findOrFail($id);
        $products = Product::all();
        return view('stock_logs.edit', compact('stockLog', 'products'));
    }

    /**
     * Update log stok
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'product_id'  => 'required|exists:products,id',
            'change_type' => 'required|in:in,out',
            'quantity'    => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $stockLog = StockLog::findOrFail($id);
        $stockLog->update([
            'product_id'  => $request->product_id,
            'change_type' => $request->change_type,
            'quantity'    => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('stock_logs.index')->with('success', 'Log stok berhasil diperbarui.');
    }

    /**
     * Hapus log stok
     */
    public function destroy($id): RedirectResponse
    {
        $stockLog = StockLog::findOrFail($id);
        $stockLog->delete();

        return redirect()->route('stock_logs.index')->with('success', 'Log stok berhasil dihapus.');
    }
}
