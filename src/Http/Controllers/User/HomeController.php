<?php

namespace App\Http\Controllers\User;

use App\Models\Business;
use App\Models\Category;
use App\Models\ContactUser;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessReview;
use App\Models\ImportantLink;

class HomeController extends Controller
{
    public function home()
    {
        return view('user.pages.home.index');
        
    }
    public function about()
    {
        // $important_links = ImportantLink::all();
        return view('user.pages.about.index');
        
    }
    public function privacy()
    {
        
        return view('user.pages.privacy.index');
        
    }

    
    public function submit_review(Request $req, $id)
    {
        // return $req;
        $review = new BusinessReview();
        $review->business_id = $req->id;
        $review->rating = $req->rating;
        $review->name = $req->name;
        $review->email = $req->email;
        $review->phone = $req->phone;
        $review->review = $req->review;
        $review->save();
        return back()->with('msg', 'Review Submitted Successfully');
    }


    public function contact()
    {
        return view('user.pages.contact');
    }
    
    public function submitQuery(Request $req)
    {
        // return $req;
        $query = new ContactUser();
        $query->name = $req->name;
        $query->phone = $req->phone;
        $query->email = $req->email;
        $query->subject = $req->message;
        $query->description = $req->message;
        $query->save();
        return view('user.pages.contact');
    }
}
