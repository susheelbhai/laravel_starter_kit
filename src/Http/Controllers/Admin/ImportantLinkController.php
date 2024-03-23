<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ImportantLink;
use App\Http\Controllers\Controller;

class ImportantLinkController extends Controller
{
    public function index()
    {
        $data = ImportantLink::all();
        return view('admin.resources.important_links.index', compact('data'));
    }

    public function create()
    {
        return view('admin.resources.important_links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'href' => 'required',
        ]);
        $important_links = new ImportantLink();
        $important_links->name = $request->name;
        $important_links->href = $request->href;
        if (isset($request->is_active)) {
            $important_links->is_active = 1;
        } else {
            $important_links->is_active = 0;
        }
        $important_links->save();
        return redirect()->route('admin.important_links.index');
    }

    public function show($id)
    {
        $data = ImportantLink::find($id);
        return view('admin.resources.important_links.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ImportantLink::find($id);
        return view('admin.resources.important_links.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'href' => 'required',
        ]);
        $important_links =  ImportantLink::find($id);

        $important_links->name = $request->name;
        $important_links->href = $request->href;
        if (isset($request->is_active)) {
            $important_links->is_active = 1;
        } else {
            $important_links->is_active = 0;
        }
        $important_links->update();
        return redirect()->route('admin.important_links.index');
    }

    public function destroy($id)
    {
        //
    }
}
