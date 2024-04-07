<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Portfolio::all();
        return view('admin.resources.portfolio.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resources.portfolio.create');
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
            'url' => 'required',
        ]);
        $image_name = 'images/portfolios/dummy.png';
        $portfolio = new Portfolio();

        if ($request->image != '') {
            $image_name = 'images/portfolios/'.uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/images/portfolios'), $image_name);
        }
        
        $portfolio->name = $request->name;
        $portfolio->url = $request->url;
        
        $portfolio->logo = $image_name;
        if (isset($request->is_active)) {
            $portfolio->is_active = 1;
        } else {
            $portfolio->is_active = 0;
        }
        $portfolio->save();
        return redirect()->route('admin.portfolio.index');
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
        return view('separate.admin.resources.portfolio.show', compact('data'));
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
        return view('separate.admin.resources.portfolio.edit', compact('data'));
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

        if ($request->image != '') {
            $image_name = 'images/portfolios/'.uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('/storage/images/portfolios'), $image_name);
            if ($portfolio->logo != 'dummy.png') {
                File::delete(public_path('storage/' .$portfolio->logo));
            }
            $portfolio->logo = $image_name;
        }

        $portfolio->name = $request->name;
        $portfolio->url = $request->url;
        
        if (isset($request->is_active)) {
            $portfolio->is_active = 1;
        } else {
            $portfolio->is_active = 0;
        }
        $portfolio->update();
        return redirect()->route('admin.portfolio.index');
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
