<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Game;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // READ: Menampilkan daftar produk
    public function index()
    {
        $products = Product::with('game')->get();
        $games = Game::all();
        return view('products.index', compact('products', 'games'));
    }

    // CREATE: Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // UPDATE: Memperbarui data produk di database
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'game_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // DELETE: Menghapus produk dari database
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
