<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use App\Http\Requests\PortfolioRequest;
use App\Http\Controllers\Controller;
// Removed unused Inertia, File, and Validator imports

class PortfolioController extends Controller
{
    public function index()
    {
        $data = Portfolio::latest()->paginate(15);
        return $this->render('admin/resources/portfolio/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/portfolio/create');
    }

    public function store(PortfolioRequest $request)
    {
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

    public function show($id)
    {
        $data = Portfolio::findOrFail($id);
        return $this->render('admin/resources/portfolio/show', compact('data'));
    }

    public function edit($id)
    {
        $data = Portfolio::find($id);
        return $this->render('admin/resources/portfolio/edit', compact('data'));
    }

    public function update(PortfolioRequest $request, $id)
    {
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
