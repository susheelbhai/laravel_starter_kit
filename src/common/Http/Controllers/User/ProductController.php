<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Events\ProductEnquirySubmitted;

class ProductController extends Controller
{
    function index()
    {
        $categories = ProductCategory::whereIsActive(1)->get();
        $data = Product::whereIsActive(1)->get()->map(function ($product) {
            return array_merge($product->toArray(), [
                'thumbnail' => $product->getFirstMediaUrl('images', 'small') ?: $product->display_img,
            ]);
        });
        return $this->render('user/pages/product/index', compact('categories', 'data'));
    }
    function productDetail($slug)
    {
        $data = Product::with('category')
            ->whereSlug($slug)
            ->whereIsActive(1)
            ->firstOrFail();
        return $this->render('user/pages/product/detail', compact('data'));
    }
    function productEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
        ]);
        $data = new \App\Models\ProductEnquiry();
        $data->product_id = $request->product_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->message = $request->message;
        $data->save();
        
        // Load the product relationship for the event
        $data->load('product');
        
        // Fire the event
        event(new ProductEnquirySubmitted($data));

        return redirect()->back()->with('success', 'Your enquiry has been submitted successfully.');
    }
}
