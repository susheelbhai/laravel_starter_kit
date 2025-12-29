<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Http\Requests\TeamRequest;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        $data = Team::latest()->paginate(15)->through(function ($team) {
            return [
                'id' => $team->id,
                'name' => $team->name,
                'designation' => $team->designation,
                'organisation' => $team->organisation ?? '',
                'message' => $team->message ?? '',
                'is_active' => $team->is_active,
                'image' => $team->image,
                'image_thumb' => $team->getFirstMediaUrl('image', 'thumb'),
            ];
        });
        return $this->render('admin/resources/team/index', compact('data'));
    }

    public function create()
    {
        return $this->render('admin/resources/team/create');
    }

    public function store(TeamRequest $request)
    {
        $team = new Team();
        
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->is_active = $request->is_active;
        $team->save();

        if ($request->hasFile('image')) {
            $team->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }
        return redirect()->route('admin.team.index')->with('success', 'New team member created successfully');
    }

    public function show($id)
    {
        $data = Team::findOrFail($id);
        return $this->render('admin/resources/team/show', compact('data'));
    }

    public function edit($id)
    {
        $data = Team::find($id);
        return $this->render('admin/resources/team/edit', compact('data'));
    }

    public function update(TeamRequest $request, $id)
    {
        $team =  Team::find($id);

        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->is_active = $request->is_active;
        $team->update();

        if ($request->hasFile('image')) {
            $team->clearMediaCollection('image');
            $team->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }
        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully');
    }

    public function destroy($id)
    {
        //
    }
}
