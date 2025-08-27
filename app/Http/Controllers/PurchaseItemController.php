<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PurchaseItemController extends Controller
{
    /**
     * index
     */
    public function index(): View
    {
    $purchaseItems = PurchaseItem::with(['product', 'purchase'])->paginate(10);


        return view('purchaseitems.index', compact('purchaseItems'));
    }

    /**
     * create
     */
    public function create(): View
    {
        $purchases = Purchase::all();
        $products  = Product::all();

        return view('purchaseitems.create', compact('purchases', 'products'));
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
        ]);

        PurchaseItem::create([
            'purchase_id' => $request->purchase_id,
            'product_id'  => $request->product_id,
            'quantity'    => $request->quantity,
            'price'       => $request->price,
            'subtotal'    => $request->quantity * $request->price,
        ]);

        return redirect()->route('purchaseitems.index')
            ->with('success', 'Purchase Item berhasil disimpan!');
    }

    /**
     * show
     */
    public function show(string $id): View
    {
        $purchaseItem = PurchaseItem::with(['purchase', 'product'])->findOrFail($id);

        return view('purchaseitems.show', compact('purchaseItem'));
    }

    /**
     * edit
     */
    public function edit(string $id): View
    {
        $purchaseItem = PurchaseItem::findOrFail($id);
        $purchases    = Purchase::all();
        $products     = Product::all();

        return view('purchaseitems.edit', compact('purchaseItem', 'purchases', 'products'));
    }

    /**
     * update
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
        ]);

        $purchaseItem = PurchaseItem::findOrFail($id);

        $purchaseItem->update([
            'purchase_id' => $request->purchase_id,
            'product_id'  => $request->product_id,
            'quantity'    => $request->quantity,
            'price'       => $request->price,
            'subtotal'    => $request->quantity * $request->price,
        ]);

        return redirect()->route('purchaseitems.index')
            ->with('success', 'Purchase Item berhasil diupdate!');
    }

    /**
     * destroy
     */
    public function destroy(string $id): RedirectResponse
    {
        $purchaseItem = PurchaseItem::findOrFail($id);
        $purchaseItem->delete();

        return redirect()->route('purchaseitems.index')
            ->with('success', 'Purchase Item berhasil dihapus!');
    }
}
