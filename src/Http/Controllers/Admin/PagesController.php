<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\PageContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function homePage()
     {
        $data = PageHome::where('id', '=', 1)->first();
        return view('admin.pages.edit_pages.home', compact('data'));
     }
     public function aboutPage()
     {
        $data = PageAbout::where('id', '=', 1)->first();
        return view('admin.pages.edit_pages.about', compact('data'));
     }
     public function contactPage()
     {
        $data = PageContact::where('id', '=', 1)->first();
        return view('admin.pages.edit_pages.contact', compact('data'));
     }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
