<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Team::latest()->get();
        return Inertia::render('admin/resources/team/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('admin/resources/team/create');
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
            'designation' => 'required',
        ]);
        $image_name = 'images/team/dummy.png';
        $team = new Team();

         if ($request->hasFile('image')) {
            $image_name = 'images/team/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/storage/images/team'), $image_name);
        }
        
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->image = $image_name;
        $team->is_active = $request->is_active;
        $team->save();
        return redirect()->route('admin.team.index')->with('success', 'New team member created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Team::findOrFail($id);
        return Inertia::render('admin/resources/team/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Team::find($id);
        return Inertia::render('admin/resources/team/edit', compact('data'));
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
            'designation' => 'required',
        ]);
        $team =  Team::find($id);

         if ($request->hasFile('image')) {
            $image_name = 'images/team/' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/storage/images/team'), $image_name);
            $team->image = $image_name;
        }

        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->is_active = $request->is_active;
        $team->update();
        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully');
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
