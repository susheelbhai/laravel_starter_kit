<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Faq::with('category')->latest()->get();
        return Inertia::render('admin/resources/faq/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = FaqCategory::get();
        return Inertia::render('admin/resources/faq/create', compact('categories'));
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
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
        $image_name = 'images/testimonials/dummy.png';
        $faq = new Faq();

        $faq->faq_category_id = $request->faq_category_id;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->is_active = $request->is_active;
        $faq->save();
        return redirect()->route('admin.faq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Faq::findOrFail($id);
        return Inertia::render('admin/resources/faq/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = FaqCategory::get();
        $data = Faq::find($id);
        return Inertia::render('admin/resources/faq/edit', compact('data', 'categories'));
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
            'faq_category_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
        $faq =  Faq::find($id);

        $faq->faq_category_id = $request->faq_category_id;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->is_active = $request->is_active;
        $faq->update();
        return redirect()->route('admin.faq.index');
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
