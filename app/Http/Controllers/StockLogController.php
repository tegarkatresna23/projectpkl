<?php

namespace App\Http\Controllers;

use App\Models\StockLog;  
use App\Models\Product;  // supaya bisa ambil data produk untuk relasi
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class StockLogController extends Controller
{
    /**
     * index
     */
    public function index(): View
    {
        // get all stock logs with product
        $stockLogs = StockLog::with('product')->latest()->paginate(10);

        return view('stocklogs.index', compact('stockLogs'));
    }

    /**
     * create
     */
    public function create(): View
    {
        // ambil data produk untuk pilihan select
        $products = Product::all();

        return view('stocklogs.create', compact('products'));
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'change_type'  => 'required|in:in,out',
            'quantity'     => 'required|integer|min:1',
            'description'  => 'nullable|string'
        ]);

        StockLog::create([
            'product_id'   => $request->product_id,
            'change_type'  => $request->change_type,
            'quantity'     => $request->quantity,
            'description'  => $request->description,
        ]);

        return redirect()->route('stocklogs.index')->with(['success' => 'Log stok berhasil ditambahkan!']);
    }

    /**
     * show
     */
    public function show(string $id): View
    {
        $stockLog = StockLog::with('product')->findOrFail($id);

        return view('stocklogs.show', compact('stockLog'));
    }

    /**
     * edit
     */
    public function edit(string $id): View
    {
        $stockLog = StockLog::findOrFail($id);
        $products = Product::all();

        return view('stocklogs.edit', compact('stockLog', 'products'));
    }

    /**
     * update
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'change_type'  => 'required|in:in,out',
            'quantity'     => 'required|integer|min:1',
            'description'  => 'nullable|string'
        ]);

        $stockLog = StockLog::findOrFail($id);

        $stockLog->update([
            'product_id'   => $request->product_id,
            'change_type'  => $request->change_type,
            'quantity'     => $request->quantity,
            'description'  => $request->description,
        ]);

        return redirect()->route('stocklogs.index')->with(['success' => 'Log stok berhasil diubah!']);
    }

    /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        $stockLog = StockLog::findOrFail($id);
        $stockLog->delete();

        return redirect()->route('stocklogs.index')->with(['success' => 'Log stok berhasil dihapus!']);
    }
}
