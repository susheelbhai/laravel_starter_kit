<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserQuery;
use App\Models\UserQueryStatus;
use Illuminate\Http\Request;

class UserQueryController extends Controller
{
    
    public function index()
    {
        return view('separate.admin.resources.user_query.index');
    }

    public function show($id)
    {
        $statuses = UserQueryStatus::all();
        $data = UserQuery::with('status')->whereId($id)->first();
        
        return view('separate.admin.resources.user_query.show', compact('data', 'statuses'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required']);
        $data = UserQuery::find($id);
        $data->status_id = $request->status;
        $data->update();
        return redirect()->route('admin.userQuery.index');
    }

}
