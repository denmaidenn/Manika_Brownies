<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $originalOrder = Product::pluck('kode_kue')->toArray();

        $products = Product::orderBy('kode_kue')->get();

        foreach ($products as $product) {
            $newOrder = array_search($product->id, $originalOrder);
            $product->update(['order' => $newOrder]);
        }
        return view('myadmin.index', compact('products'));
    }

    public function create()
    {
        return view('myadmin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kue' => 'required',
            'deskripsi' => 'required',
            'harga_kue' => 'required|numeric',
            'gambar_kue' => 'image|nullable',
        ]);

        if ($request->hasFile('gambar_kue')) {
            $validated['gambar_kue'] = $request->file('gambar_kue')->store('images', 'public');
        }
        Product::create($validated);

        return redirect()->route('myadmin.index');
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('myadmin.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'nama_kue' => 'required',
            'deskripsi' => 'required',
            'harga_kue' => 'required|numeric',
            'gambar_kue' => 'image|nullable',
        ]);

        if ($request->hasFile('gambar_kue')) {
            if ($product->gambar_kue) {
                Storage::delete('public/' . $product->gambar_kue);
            }
            $validated['gambar_kue'] = $request->file('gambar_kue')->store('images', 'public');
        }

        $product->update($validated);

        return redirect()->route('myadmin.index');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->gambar_kue) {
            Storage::delete('public/' . $product->gambar_kue);
        }
        $product->delete();
        return redirect()->route('myadmin.index');
    }

    public function setBestSeller(Request $request, $kode_kue)
    {
        $product = Product::findOrFail($kode_kue);
        $status = $request->input('status');

        if (Product::where('status_bs', true)->count() >= 4 && $status) {
            return response()->json([
                'success' => false,
                'message' => 'Maksimal hanya 4 kue yang dapat dijadikan Best Seller.'
            ]);
        }

        $product->update(['status_bs' => $status]);

        return response()->json(['success' => true]);
    }
}
