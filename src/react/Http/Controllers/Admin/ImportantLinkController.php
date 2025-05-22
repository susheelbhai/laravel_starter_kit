<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ImportantLink;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ImportantLinkController extends Controller
{
    public function index()
    {
        $data = ImportantLink::all();
        return Inertia::render('admin/resources/important_links/index', compact('data'));
    }

    public function create()
    {
        return Inertia::render('admin/resources/important_links/create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'href' => 'required',
        ]);
    
        if ($validator->fails()) {
            return Inertia::render('admin/resources/important_links/create', [
                'errors' => $validator->errors(),
                'data' => $request->all(), // Optionally pass back the submitted data
            ]);
        }
        $important_links = new ImportantLink();
        $important_links->name = $request->name;
        $important_links->href = $request->href;
        $important_links->is_active = $request->is_active;
        $important_links->save();
        return redirect()->route('admin.important_links.index');
    }

    public function show($id)
    {
        $data = ImportantLink::find($id);
        return Inertia::render('admin/resources/important_links/show', compact('data'));
    }

    public function edit($id)
    {
        $data = ImportantLink::find($id);
        return Inertia::render('admin/resources/important_links/edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'href' => 'required',
        ]);
    
        if ($validator->fails()) {
            return Inertia::render('admin/resources/important_links/create', [
                'errors' => $validator->errors(),
                'data' => $request->all(), // Optionally pass back the submitted data
            ]);
        }

        $important_links =  ImportantLink::find($id);
        $important_links->name = $request->name;
        $important_links->href = $request->href;
        $important_links->is_active = $request->is_active;

        $important_links->update();
        return redirect()->route('admin.important_links.index');
    }

    public function destroy($id)
    {
        //
    }
}
