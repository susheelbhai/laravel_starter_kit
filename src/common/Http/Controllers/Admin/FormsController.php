<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormWizardRequest;

class FormsController extends Controller
{
    public function simpleCreate()
    {
        return $this->render('admin/resources/forms/simple-create');
    }
    
    public function editorCreate()
    {
        return $this->render('admin/resources/forms/editor-create');
    }
    public function dateCreate()
    {
        return $this->render('admin/resources/forms/date-create');
    }
    public function selectCreate()
    {
        $states = [
            ['title' => 'Alabama', 'id' => 'AL'],
            ['title' => 'Alaska', 'id' => 'AK'],
            ['title' => 'Arizona', 'id' => 'AZ'],
            ['title' => 'Arkansas', 'id' => 'AR'],
            ['title' => 'California', 'id' => 'CA'],
            ['title' => 'Colorado', 'id' => 'CO'],
            ['title' => 'Connecticut', 'id' => 'CT'],
            ['title' => 'Delaware', 'id' => 'DE'],
            ['title' => 'Florida', 'id' => 'FL'],
            ['title' => 'Georgia', 'id' => 'GA'],
        ];
        return $this->render('admin/resources/forms/select-create', compact('states'));
    }
    public function fileCreate()
    {
        return $this->render('admin/resources/forms/file-create');
    }
    public function imageCreate()
    {
        return $this->render('admin/resources/forms/image-create');
    }
    public function storeSimpleForm(Request $request)
    {
      
        // $request->validate([
        //     'text' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);
        dd($request->all());
        return redirect()->route('admin.forms.simple')->with('success', 'Simple form submitted successfully!');
    }

    public function wizardForm()
    {
        $data = [];
        return $this->render('admin/resources/forms/wizard/create', compact('data'));
    }
    public function partialUpdateWizard(FormWizardRequest $request)
    {
        $data = [];
        // dd($request->all());
        return back()->with('success', ucfirst(str_replace('_', ' ', $request['field'])) . ' updated successfully!');
    }
    public function submitWizard(Request $request)
    {
        $data = $request->all();
        // dd($data);
        return redirect()->route('admin.dashboard')->with('success', 'Wizard form submitted successfully!');
    }
}
