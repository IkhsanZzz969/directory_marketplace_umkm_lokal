<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('pages.products.product-create', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        Category::create($validated);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|max:170|unique:products,slug',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:50|max:2000',
            'is_featured' => 'nullable|boolean',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['shop_id'] = 1; // Assuming shop_id 1 for now, should be from auth user
        $validated['is_featured'] = $request->has('is_featured');
        $validated['views_count'] = 0;

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0, // first image is primary
                ]);
            }
        }

        return redirect()->route('shop.manage')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        // Assuming edit view exists
        return view('pages.shop.edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|max:170|unique:products,slug,'.$product->id,
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:50|max:2000',
            'is_featured' => 'nullable|boolean',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        if ($request->hasFile('images')) {
            // Option 1: replace all images, Option 2: append. Let's just append or replace
            // For simplicity, if new images uploaded, we might want to delete old ones
            $product->images()->delete();
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()->route('shop.manage')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        // Delete images
        $product->images()->delete();
        $product->delete();

        return redirect()->route('shop.manage')->with('success', 'Produk berhasil dihapus!');
    }

    public function show($slug)
    {
        $product = Product::with(['shop', 'images', 'category'])->where('slug', $slug)->firstOrFail();

        // Increment views
        $product->increment('views_count');

        // Fetch related products from the same shop
        $relatedProducts = Product::with(['primaryImage'])->where('shop_id', $product->shop_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('pages.products.product-detail', compact('product', 'relatedProducts'));
    }
}
