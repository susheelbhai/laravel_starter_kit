<?php

namespace App\Http\Controllers\User;

use App\Models\PageTnc;
use App\Models\Slider1;
use App\Models\PageAbout;
use App\Models\UserQuery;
use App\Models\PageContact;
use App\Models\PagePrivacy;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $slider1 = Slider1::all();
        return view('user.pages.home.index', compact('slider1'));
        
    }
    public function about()
    {
        $data = PageAbout::where('id', '=', 1)->first();
        $testimonials = Testimonial::whereIsActive(1)->get();
        return view('user.pages.about.index', compact('data', 'testimonials'));
        
    }
    public function tnc()
    {
        $data = PageTnc::where('id', '=', 1)->first();
        return view('user.pages.tnc', compact('data'));
        
    }

    
    public function privacy()
    {
        $data = PagePrivacy::where('id', '=', 1)->first();
        return view('user.pages.privacy', compact('data'));
        
    }

    
   


    public function contact()
    {
        $data = PageContact::where('id', '=', 1)->first();
        return view('user.pages.contact', compact('data'));
    }
    
    public function submitQuery(Request $req)
    {
        // return $req;
        $req->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $query = new UserQuery();
        $query->name = $req->name;
        $query->phone = $req->phone;
        $query->email = $req->email;
        $query->subject = $req->subject;
        $query->message = $req->message;
        $query->save();
        return back()->with('message', 'Your query has been submitted successfully');
    }
}
