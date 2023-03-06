<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ImportantLink;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ImportantLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ImportantLink::all();
        return view('admin.resources.important_links.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resources.important_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required',
            'href' => 'required',
        ]);
        $important_links = new ImportantLink();

        if ($request->image != '') {
            $image_name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/common/images/important_link'), $image_name);
            File::delete(public_path('storage/common/images/important_link/' . Auth::guard('admin')->user()->image));
            $important_links->image = $image_name;
        }

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ImportantLink::find($id);
        return view('admin.resources.important_links.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ImportantLink::find($id);
        return view('admin.resources.important_links.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'href' => 'required',
        ]);
        $important_links =  ImportantLink::find($id);

        if ($request->image != '') {
            $image_name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/common/images/important_link'), $image_name);
            File::delete(public_path('storage/common/images/important_link/' . Auth::guard('admin')->user()->image));
            $important_links->image = $image_name;
        }


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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
