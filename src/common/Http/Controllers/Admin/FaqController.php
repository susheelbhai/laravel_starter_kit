<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Requests\FaqRequest;
use App\Http\Controllers\Controller;
use App\Models\FaqCategory;

class FaqController extends Controller
{
    public function index()
    {
        $data = Faq::with('category')->latest()->get();
        return $this->render('admin/resources/faq/index', compact('data'));
    }

    public function create()
    {
        $categories = FaqCategory::get();
        return $this->render('admin/resources/faq/create', compact('categories'));
    }

    public function store(FaqRequest $request)
    {
        $image_name = 'images/testimonials/dummy.png';
        $faq = new Faq();

        $faq->faq_category_id = $request->faq_category_id;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->is_active = $request->is_active;
        $faq->save();
        return redirect()->route('admin.faq.index')->with('success', 'New Faq created successfully');
    }

    public function show($id)
    {
        $data = Faq::findOrFail($id);
        return $this->render('admin/resources/faq/show', compact('data'));
    }

    public function edit($id)
    {
        $categories = FaqCategory::get();
        $data = Faq::find($id);
        return $this->render('admin/resources/faq/edit', compact('data', 'categories'));
    }

    public function update(FaqRequest $request, $id)
    {
        $faq =  Faq::find($id);

        $faq->faq_category_id = $request->faq_category_id;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->is_active = $request->is_active;
        $faq->update();
        return redirect()->route('admin.faq.index')->with('success', 'Faq updated successfully');
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
