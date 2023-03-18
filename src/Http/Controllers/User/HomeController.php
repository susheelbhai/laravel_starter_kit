<?php

namespace App\Http\Controllers\User;

use App\Models\UserQuery;
use App\Models\PageContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        ]);
        $query = new UserQuery();
        $query->name = $req->name;
        $query->phone = $req->phone;
        $query->email = $req->email;
        $query->subject = $req->subject;
        $query->description = $req->description;
        $query->save();
        return view('user.pages.contact');
    }
}
