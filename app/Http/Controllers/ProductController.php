<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\Categorie;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     */
    public function index() : View
    {
        // Ambil semua produk dengan kategori
        $products = Product::with('category')
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * create
     */
    public function create(): View
    {
        // Ambil semua kategori untuk dropdown
        $categories = Categorie::all();
        return view('products.create', compact('categories'));
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'code'           => 'required|string|max:50|unique:products,code',
            'name'           => 'required|string|max:150',
            'description'    => 'nullable|string',
            'stock'          => 'required|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data = $request->only([
            'category_id', 'code', 'name', 'description',
            'stock', 'purchase_price', 'selling_price'
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
            $data['image'] = $image->hashName();
        }

        Product::create($data);

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     */
    public function show(string $id): View
    {
        // Ambil produk dengan kategori
        $product = Product::with('category')->findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * edit
     */
    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        $categories = Categorie::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * update
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        // Validasi form
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'code'           => 'required|string|max:50|unique:products,code,'.$product->id,
            'name'           => 'required|string|max:150',
            'description'    => 'nullable|string',
            'stock'          => 'required|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data = $request->only([
            'category_id', 'code', 'name', 'description',
            'stock', 'purchase_price', 'selling_price'
        ]);

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/products/'.$product->image);
            }
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
            $data['image'] = $image->hashName();
        }

        $product->update($data);

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $product = Product::findOrFail($id);

        //delete image
        Storage::delete('products/'. $product->image);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
}
