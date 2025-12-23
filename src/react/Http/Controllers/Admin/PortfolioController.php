<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Portfolio::latest()->paginate(15);
        return Inertia::render('admin/resources/portfolio/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('admin/resources/portfolio/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
             'name' => 'required',
            'url' => 'required',
        ]);
        
        $portfolio = new Portfolio();
        $portfolio->name = $request->name;
        $portfolio->url = $request->url;
        $portfolio->is_active = $request->is_active;
        $portfolio->save();

        if ($request->hasFile('logo')) {
            $portfolio->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }
        return redirect()->route('admin.portfolio.index')->with('success', 'New portfolio created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Portfolio::findOrFail($id);
        return Inertia::render('admin/resources/portfolio/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Portfolio::find($id);
        return Inertia::render('admin/resources/portfolio/edit', compact('data'));
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
        // return $request;
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);
        $portfolio =  Portfolio::find($id);

        $portfolio->name = $request->name;
        $portfolio->url = $request->url;
        $portfolio->is_active = $request->is_active;
        $portfolio->update();

        if ($request->hasFile('logo')) {
            $portfolio->clearMediaCollection('logo');
            $portfolio->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio updated successfully');
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
