<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\MediaExternal;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::latest()->get()->map(function ($product) {
            $media = $product->getMedia('images');
            return [
                ...$product->toArray(),
                'thumbnail' => $media->first()?->getUrl('thumb'),
                'images' => $media->map(fn($m) => $m->getUrl()),
            ];
        });
        return $this->render('admin/resources/product/index', compact('data'));
    }

    public function create()
    {
        $categories = ProductCategory::whereNull('parent_id')
            ->latest()
            ->get(['id', 'title']);

        return $this->render('admin/resources/product/create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        // dd($request->all());
        $data = new Product();

        $data->seller_id = $request->seller_id;
        $data->product_category_id = $request->product_category_id;

        $data->title = $request->title;
        $data->slug = $this->uniqueSlug(
            $request->slug ? Str::slug($request->slug) : Str::slug($request->title)
        );

        $data->sku = $request->sku;

        $data->short_description = $request->short_description;
        $data->description = $request->description;
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->features = $request->features;

        $data->price = $request->price;
        $data->original_price = $request->original_price;
        $data->mrp = $request->mrp;

        $data->stock = $request->stock ?? 0;
        $data->manage_stock = (int) $request->manage_stock;

        $data->is_active = (int) $request->is_active;
        $data->is_featured = (int) $request->is_featured;

        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;

        $data->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $data->addMedia($file)
                    ->toMediaCollection('images');
            }
        }

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'New product created successfully');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $media = $product->getMedia('images');
        $data = [
            ...$product->toArray(),
            'thumbnail' => $media->first()?->getUrl('thumb'),
            'images' => $media->map(fn($m) => $m->getUrl()),
        ];
        return $this->render('admin/resources/product/show', compact('data'));
    }

    public function edit($id)
    {
        $categories = ProductCategory::whereNull('parent_id')
            ->latest()
            ->get(['id', 'title']);

        $product = Product::with('category')->findOrFail($id);
        $media = $product->getMedia('images');
        $data = [
            ...$product->toArray(),
            'thumbnail' => $media->first()?->getUrl('thumb'),
            'images' => $media->map(fn($m) => [
                'id' => $m->id,
                'url' => $m->getUrl(),
                'thumb' => $m->getUrl('thumb'),
                'small' => $m->getUrl('small'),
                'medium' => $m->getUrl('medium'),
                'large' => $m->getUrl('large'),
                'xlarge' => $m->getUrl('xlarge'),
            ]),
        ];
        return $this->render('admin/resources/product/edit', compact('data', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        // dd($request->all());

        $data = Product::findOrFail($id);

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
        $data->long_description2 = $request->long_description2;
        $data->long_description3 = $request->long_description3;
        $data->features = $request->features;

        $data->price = $request->price;
        $data->original_price = $request->original_price;
        $data->mrp = $request->mrp;

        $data->stock = $request->stock ?? 0;
        $data->manage_stock = (int) $request->manage_stock;

        $data->is_active = (int) $request->is_active;
        $data->is_featured = (int) $request->is_featured;

        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;

        $data->update();

        // Handle deleted images - properly delete files and database entries
        if ($request->has('deleted_images_ids') && is_array($request->deleted_images_ids)) {
            $mediaItems = MediaExternal::whereIn('id', $request->deleted_images_ids)
                ->where('model_type', Product::class)
                ->where('model_id', $data->id)
                ->get();
            
            foreach ($mediaItems as $media) {
                $media->delete(); // This triggers Spatie's cleanup and deletes actual files
            }
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $data->addMedia($file)
                    ->toMediaCollection('images');
            }
        }

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
