<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\PageAbout;
use App\Models\PageContact;
use App\Models\PagePrivacy;
use App\Models\PageRefund;
use App\Models\PageTnc;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\UserQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Events\ContactFormSubmitted;

class HomeController extends Controller
{
    function dashboard()
    {
        $services = Service::whereIsActive(1)->get();
        $team = Team::whereIsActive(1)->get();
        $testimonials = Testimonial::whereIsActive(1)->get();
        $clients = Portfolio::whereIsActive(1)->get();
        return Inertia::render('user/dashboard', compact( 'services', 'testimonials', 'team', 'clients'));
    }
    function home()
    {
        $services = Service::whereIsActive(1)->get();
        $team = Team::whereIsActive(1)->get();
        $testimonials = Testimonial::whereIsActive(1)->get();
        $clients = Portfolio::whereIsActive(1)->get();
        return Inertia::render('user/pages/home/index', compact( 'services', 'testimonials', 'team', 'clients'));
    }
    function about()
    {
        $data = PageAbout::firstOrFail();
        return Inertia::render('user/pages/about/index', compact( 'data'));
    }
    
    function services()
    {
        $data = Service::whereIsActive(1)->get();
        return Inertia::render('user/pages/service/index', compact('data'));
    }
    function serviceDetail($slug)
    {
        $data = Service::whereSlug($slug)->whereIsActive(1)->firstOrFail();
        return Inertia::render('user/pages/service/detail', compact('data'));
    }
    function contact()
    {
        $data = PageContact::firstOrFail();
        return Inertia::render('user/pages/contact/index', compact( 'data'));
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
        event(new ContactFormSubmitted($data['id']));
        return back()->with('success', 'You have successfully submitted the form');
    }

    function newsletter(Request $request)
    {
        $data = Newsletter::updateOrCreate(
            ['email' => $request['email']],
            ['unsubscribed_at' => null]
        );
        return back()->with('success', 'You have successfully subscribed to our newwsletter');
    }

    function privacy()
    {
        $data = PagePrivacy::whereId(1)->first();
        return Inertia::render('user/pages/privacy', compact( 'data'));
    }
    function tnc()
    {
        $data = PageTnc::whereId(1)->first();
        return Inertia::render('user/pages/tnc', compact( 'data'));
    }
    function refund()
    {
        $data = PageRefund::whereId(1)->first();
        return Inertia::render('user/pages/refund', compact( 'data'));
    }
}
