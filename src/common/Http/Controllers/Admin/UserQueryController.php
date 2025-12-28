<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\UserQuery;
use Illuminate\Http\Request;
use App\Models\UserQueryStatus;
use App\Http\Controllers\Controller;

class UserQueryController extends Controller
{
    
    public function index()
    {
        $data = UserQuery::with('status')->latest('id')->paginate(15);
        return $this->render('admin/resources/user_query/index', compact('data'));
    }

    public function show($id)
    {
        $statuses = UserQueryStatus::all();
        $data = UserQuery::with('status')->whereId($id)->first();
        return $this->render('admin/resources/user_query/show', [
            'data' => $data,
            'statuses' => $statuses,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required']);
        $data = UserQuery::find($id);
        $data->status_id = $request->status;
        $data->update();
        return redirect()->route('admin.userQuery.index')->with('success', 'status updated successfully');
    }

}
