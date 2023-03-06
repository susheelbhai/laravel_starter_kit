<?php

namespace App\Http\Controllers\Admin;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BusinessRepository;
use App\Http\Requests\Business\StoreRequest;
use App\Http\Requests\Business\UpdateRequest;

class BusinessController extends Controller
{
    public $repository;
    public function __construct(BusinessRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Business::all();
        return view('admin.resources.business.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id as value', 'name as lbl' )->get();
        // return 1;
        return view('admin.resources.business.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->repository->store($request);        
        return redirect()->route('admin.business.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Business::whereId($id)->with('category', 'subCategory')->first();
        return view('admin.resources.business.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Business::findOrFail($id);

        return view('admin.resources.business.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        
        $this->repository->update($request, $id);        
        return redirect()->route('admin.business.index');
    }

    public function approve(Request $req)
    {
        Business::findOrFail($req->id)->update(['is_approved' => 1]);
        return back()->with('msg', 'Bussiness Approved Successfully');
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
