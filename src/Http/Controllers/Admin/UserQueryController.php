<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserQuery;
use App\Models\UserQueryStatus;
use Illuminate\Http\Request;

class UserQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserQuery::with('status')->latest();
        if (request()->has('search') && !empty(request()->search)) {
           $data->where('name', 'like', '%'. request()->search. '%');
           $data->orWhere('email', 'like', '%'. request()->search. '%');
        }
        $data = $data->paginate(15)->withQueryString();
        return view('admin.resources.user_query.index', compact('data'));

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statuses = UserQueryStatus::all();
        $data = UserQuery::with('status')->whereId($id)->first();
        
        return view('admin.resources.user_query.view', compact('data', 'statuses'));
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
        $request->validate(['status' => 'required']);
        $data = UserQuery::find($id);
        $data->status_id = $request->status;
        $data->update();
        return redirect()->route('admin.userQuery.index');
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
