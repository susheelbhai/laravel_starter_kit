<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $data = ProductCategory::latest()->paginate(15)->through(function ($category) {
            return array_merge($category->toArray(), [
                'icon_thumb' => $category->getFirstMediaUrl('icon', 'thumb'),
            ]);
        });
        return $this->render('admin/resources/product_category/index', compact('data'));
    }

    public function create()
    {
        $parents = ProductCategory::whereNull('parent_id')
            ->latest()
            ->get(['id', 'title']);

        return $this->render('admin/resources/product_category/create', compact('parents'));
    }

    public function store(ProductCategoryRequest $request)
    {
        $data = new ProductCategory();

        $data->parent_id = $request->parent_id ?: null;

        $data->title = $request->title;
        $data->slug = $this->uniqueSlug($request->slug ? Str::slug($request->slug) : Str::slug($request->title));

        $data->description = $request->description;

        $data->position = $request->position ?? 0;
        $data->is_active = (int) $request->is_active;
        $data->is_featured = (int) $request->is_featured;

        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;

        $data->save();

        if ($request->hasFile('icon')) {
            $data->addMediaFromRequest('icon')
                ->toMediaCollection('icon');
        }

        if ($request->hasFile('banner')) {
            $data->addMediaFromRequest('banner')
                ->toMediaCollection('banner');
        }

        return redirect()
            ->route('admin.product_category.index')
            ->with('success', 'New Product Category created successfully');
    }

    public function show($id)
    {
        $data = ProductCategory::findOrFail($id);
        return $this->render('admin/resources/product_category/show', compact('data'));
    }

    public function edit($id)
    {
        $data = ProductCategory::findOrFail($id);
        $parents = ProductCategory::whereNull('parent_id')
            ->latest()
            ->get(['id', 'title']);

        return $this->render('admin/resources/product_category/edit', compact('parents','data'));
    }

    public function update(ProductCategoryRequest $request, $id)
    {
        $data = ProductCategory::findOrFail($id);

        $data->parent_id = $request->parent_id ?: null;

        $data->title = $request->title;
        $data->slug = $this->uniqueSlug(
            $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            $data->id
        );

        $data->description = $request->description;

        $data->position = $request->position ?? 0;
        $data->is_active = (int) $request->is_active;
        $data->is_featured = (int) $request->is_featured;

        $data->meta_title = $request->meta_title;
        $data->meta_description = $request->meta_description;

        $data->update();

        if ($request->hasFile('icon')) {
            $data->clearMediaCollection('icon');
            $data->addMediaFromRequest('icon')
                ->toMediaCollection('icon');
        }

        if ($request->hasFile('banner')) {
            $data->clearMediaCollection('banner');
            $data->addMediaFromRequest('banner')
                ->toMediaCollection('banner');
        }

        return redirect()
            ->route('admin.product_category.index')
            ->with('success', 'Product category updated successfully');
    }

    public function destroy(ProductCategory $product_category)
    {
        // optional: delete files if you want
        // if ($product_category->icon && file_exists(public_path('storage/'.$product_category->icon))) {
        //     @unlink(public_path('storage/'.$product_category->icon));
        // }
        // if ($product_category->banner && file_exists(public_path('storage/'.$product_category->banner))) {
        //     @unlink(public_path('storage/'.$product_category->banner));
        // }

        $product_category->delete();

        return redirect()
            ->route('admin.product_category.index')
            ->with('success', 'Product category deleted successfully');
    }

    /**
     * Generate a unique slug for categories.
     */
    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = Str::slug($slug);
        $slug = $slug !== '' ? $slug : Str::random(8);

        $query = ProductCategory::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        if (! $query->exists()) {
            return $slug;
        }

        $i = 2;
        while (true) {
            $candidate = "{$slug}-{$i}";
            $q = ProductCategory::where('slug', $candidate);
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
