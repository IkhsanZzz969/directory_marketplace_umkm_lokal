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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|max:170|unique:products,slug',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'min_order' => 'nullable|integer|min:1',
            'weight' => 'nullable|integer|min:1',
            'stock_status' => 'nullable|string|in:available,preorder,limited,empty',
            'preorder_days' => 'nullable|integer|min:1',
            'preorder_unit' => 'nullable|string|max:20',
            'description' => 'required|string|min:50|max:2000',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|string|in:active,draft,archived',
            'tags' => 'nullable|string',
            'shipping_note' => 'nullable|string|max:500',
            'dimension_length' => 'nullable|numeric|min:0',
            'dimension_width' => 'nullable|numeric|min:0',
            'dimension_height' => 'nullable|numeric|min:0',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['shop_id'] = auth()->user()->shops->id;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['views_count'] = 0;
        $validated['stock_status'] = $validated['stock_status'] ?? 'available';
        $validated['status'] = $validated['status'] ?? 'active';
        $validated['unit'] = $validated['unit'] ?? 'pcs / buah';
        $validated['min_order'] = $validated['min_order'] ?? 1;

        // Parse tags from comma-separated string to JSON array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

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
            'original_price' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'min_order' => 'nullable|integer|min:1',
            'weight' => 'nullable|integer|min:1',
            'stock_status' => 'nullable|string|in:available,preorder,limited,empty',
            'preorder_days' => 'nullable|integer|min:1',
            'preorder_unit' => 'nullable|string|max:20',
            'description' => 'required|string|min:50|max:2000',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|string|in:active,draft,archived',
            'tags' => 'nullable|string',
            'shipping_note' => 'nullable|string|max:500',
            'dimension_length' => 'nullable|numeric|min:0',
            'dimension_width' => 'nullable|numeric|min:0',
            'dimension_height' => 'nullable|numeric|min:0',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        // Parse tags from comma-separated string to JSON array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $product->update($validated);

        if ($request->hasFile('images')) {
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
