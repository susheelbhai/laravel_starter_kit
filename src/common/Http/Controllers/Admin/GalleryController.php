<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\MediaInternal;

class GalleryController extends Controller
{
    public function index()
    {
        $data = Gallery::latest()->get()->map(function ($product) {
            $media = $product->getMedia('images');

            return [
                ...$product->toArray(),
                'thumbnail' => $media->first()?->getUrl('thumb'),
                'images' => $media->map(fn ($m) => $m->getUrl()),
            ];
        });

        return $this->render('admin/resources/gallery/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/gallery/create');
    }

    public function store(GalleryRequest $request)
    {
        $data = new Gallery;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $data->addMedia($file)
                    ->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.gallery.index')->with('success', 'New gallery created successfully');
    }

    public function show($id)
    {
        $data = Gallery::findOrFail($id);
        $media = $data->getMedia('images');
        $data = [
            ...$data->toArray(),
            'thumbnail' => $media->first()?->getUrl('thumb'),
            'images' => $media->map(fn ($m) => $m->getUrl()),
            'media' => $media->map(function ($m) {
                return [
                    ...$m->toArray(),
                    'generated_conversions' => $m->getSortedConversions(),
                ];
            }),
        ];

        return $this->render('admin/resources/gallery/show', compact('data'));
    }

    public function edit($id)
    {
        $data = Gallery::findOrFail($id);
        $media = $data->getMedia('images');
        $data = [
            ...$data->toArray(),
            'thumbnail' => $media->first()?->getUrl('thumb'),
            'images' => $media->map(fn ($m) => $m->getUrl()),
            'media' => $media,
        ];

        return $this->render('admin/resources/gallery/edit', compact('data'));
    }

    public function update(GalleryRequest $request, $id)
    {
        $data = Gallery::findOrFail($id);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();
        // dd($request->all());
        if ($request->has('deleted_images_ids') && is_array($request->deleted_images_ids)) {
            $mediaItems = MediaInternal::whereIn('id', $request->deleted_images_ids)
                ->where('model_type', Gallery::class)
                ->where('model_id', $data->id)
                ->get();

            foreach ($mediaItems as $media) {
                $media->delete(); // This triggers Spatie's cleanup and deletes actual files
            }
        }
        // Add new images if uploaded
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $data->addMedia($file)
                    ->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery updated successfully');
    }

    public function destroy($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->clearMediaCollection('images');
            $gallery->delete();

            return redirect()->route('admin.gallery.index')->with('success', 'Gallery deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete gallery: '.$e->getMessage());
        }
    }
}


