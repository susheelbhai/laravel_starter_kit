<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\ProductEnquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductEnquiryController extends Controller
{
    
    public function index()
    {
        $data = ProductEnquiry::with('product')->latest('id')->paginate(15);
        return $this->render('admin/resources/product_enquiry/index', compact('data'));
    }

    public function show($id)
    {
        $data = ProductEnquiry::with('product')->whereId($id)->first();
        return $this->render('admin/resources/product_enquiry/show', [
            'data' => $data,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required']);
        $data = ProductEnquiry::find($id);
        $data->status = $request->status;
        $data->update();
        return redirect()->route('admin.productEnquiry.index')->with('success', 'Status updated successfully');
    }

}
