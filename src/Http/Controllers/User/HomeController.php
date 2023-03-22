<?php

namespace App\Http\Controllers\User;

use App\Models\PageAbout;
use App\Models\UserQuery;
use App\Models\PageContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider1;

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
        return view('user.pages.about.index', compact('data'));
        
    }
    public function privacy()
    {
        
        return view('user.pages.privacy.index');
        
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
