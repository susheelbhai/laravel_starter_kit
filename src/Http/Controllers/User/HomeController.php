<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Newsletter;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\UserQuery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    function dashboard(): View
    {
        return view('user.dashboard');
    }
    function home(): View
    {
        $testimonials = Testimonial::whereIsActive(1)->get();
        $clients = Portfolio::whereIsActive(1)->get();
        return view('user.pages.home.index', compact('testimonials', 'clients'));
    }
    function about(): View
    {
        return view('user.pages.about.index');
    }
    function blogs(): View
    {
        $data = Blog::whereIsActive(1)->paginate();
        return view('user.pages.blog.index', compact('data'));
    }
    function blogDetail($slug): View
    {
        $data = Blog::whereSlug($slug)->whereIsActive(1)->firstOrFail();
        return view('user.pages.blog.detail', compact('data'));
    }
    function services(): View
    {
        $data = Service::whereIsActive(1)->paginate();
        return view('user.pages.service.index', compact('data'));
    }
    function serviceDetail($slug): View
    {
        $data = Service::whereSlug($slug)->whereIsActive(1)->firstOrFail();
        return view('user.pages.service.detail', compact('data'));
    }
    function contact(): View
    {
        return view('user.pages.contact.index');
    }
    function contactSubmit(Request $request)
    {
        $data = new UserQuery();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->phone = $request['phone'];
        $data->subject = $request['subject'];
        $data->message = $request['message'];
        $data->save();
        return 'Your Request is submitted successfully';
    }
    function newsletter(Request $request)
    {
        $data = Newsletter::updateOrCreate(
            ['email' => $request['email']],
            ['unsubscribed_at' => null]
        );
        return back()->with('success', 'You have successfully subscribed to our newwsletter');
    }
}
