<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::latest()->get();
        return Inertia::render('admin/resources/product/index', compact('data'));
    }

    public function create()
    {
        $categories = ProductCategory::whereNull('parent_id')
            ->latest()
            ->get(['id', 'title']);

        return Inertia::render('admin/resources/product/create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // ✅ your pattern: validate + manual assign + image move to public/storage
        $request->validate([
            'seller_id' => 'required|integer|exists:sellers,id',
            'product_category_id' => 'required|integer|exists:product_categories,id',

            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',

            'short_description' => 'nullable|string',
            'description' => 'nullable|string',

            'price' => 'required|numeric|min:0',
            'mrp' => 'nullable|numeric|min:0',

            'stock' => 'nullable|integer|min:0',
            'manage_stock' => 'required|in:0,1',

            'thumbnail' => 'nullable|image|max:5120',
            'gallery' => 'nullable', // can be string or multiple files (handle later)

            'is_active' => 'required|in:0,1',
            'is_featured' => 'required|in:0,1',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $thumbnail_name = null;

        $data = new Product();

        if ($request->hasFile('thumbnail')) {
            $thumbnail_name = 'images/products/' . uniqid() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->move(public_path('/storage/images/products'), $thumbnail_name);
        }

        $data->seller_id = $request->seller_id;
        $data->product_category_id = $request->product_category_id;

        $data->title = $request->title;
        $data->slug = $this->uniqueSlug(
            $request->slug ? Str::slug($request->slug) : Str::slug($request->title)
        );

        $data->sku = $request->sku;

        $data->short_description = $request->short_description;
        $data->description = $request->description;

        $data->price = $request->price;
        $data->mrp = $request->mrp;

        $data->stock = $request->stock ?? 0;
        $data->manage_stock = (int) $request->manage_stock;

        $data->thumbnail = $thumbnail_name;

        // Keep as-is for now (string). Later you can convert to JSON or separate table.
        $data->gallery = $request->gallery;

        $data->is_active = (int) $request->is_active;
        $data->is_featured = (int) $request->is_featured;

        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;

        // optional audit (only if column exists)
        // $data->created_by_admin_id = auth('admin')->id();

        $data->save();

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'New product created successfully');
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);
        return Inertia::render('admin/resources/product/show', compact('data'));
    }

    public function edit($id)
    {
        $categories = ProductCategory::whereNull('parent_id')
            ->latest()
            ->get(['id', 'title']);

        $data = Product::findOrFail($id);
        return Inertia::render('admin/resources/product/edit', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'seller_id' => 'required|integer|exists:sellers,id',
            'product_category_id' => 'required|integer|exists:product_categories,id',

            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',

            'short_description' => 'nullable|string',
            'description' => 'nullable|string',

            'price' => 'required|numeric|min:0',
            'mrp' => 'nullable|numeric|min:0',

            'stock' => 'nullable|integer|min:0',
            'manage_stock' => 'required|in:0,1',

            'thumbnail' => 'nullable|image|max:5120',
            'gallery' => 'nullable',

            'is_active' => 'required|in:0,1',
            'is_featured' => 'required|in:0,1',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $data = Product::findOrFail($id);

        $thumbnail_name = $data->thumbnail;

        if ($request->hasFile('thumbnail')) {
            $thumbnail_name = 'images/products/' . uniqid() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->move(public_path('/storage/images/products'), $thumbnail_name);
        }

        $data->seller_id = $request->seller_id;
        $data->product_category_id = $request->product_category_id;

        $data->title = $request->title;
        $data->slug = $this->uniqueSlug(
            $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            $data->id
        );

        $data->sku = $request->sku;

        $data->short_description = $request->short_description;
        $data->description = $request->description;

        $data->price = $request->price;
        $data->mrp = $request->mrp;

        $data->stock = $request->stock ?? 0;
        $data->manage_stock = (int) $request->manage_stock;

        $data->thumbnail = $thumbnail_name;
        $data->gallery = $request->gallery;

        $data->is_active = (int) $request->is_active;
        $data->is_featured = (int) $request->is_featured;

        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;

        $data->update();

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        // optional: delete file if you want
        // if ($product->thumbnail && file_exists(public_path('storage/' . $product->thumbnail))) {
        //     @unlink(public_path('storage/' . $product->thumbnail));
        // }

        $product->delete();

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product deleted successfully');
    }

    /**
     * Generate a unique slug for products.
     */
    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = Str::slug($slug);
        $slug = $slug !== '' ? $slug : Str::random(8);

        $query = Product::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        if (! $query->exists()) {
            return $slug;
        }

        $i = 2;
        while (true) {
            $candidate = "{$slug}-{$i}";
            $q = Product::where('slug', $candidate);
            if ($ignoreId) {
                $q->where('id', '!=', $ignoreId);
            }
            if (! $q->exists()) {
                return $candidate;
            }
            $i++;
        }
    }
}
