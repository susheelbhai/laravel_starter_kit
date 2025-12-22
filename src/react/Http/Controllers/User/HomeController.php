<?php

namespace App\Http\Controllers\User;

use App\Models\Faq;
use App\Models\Team;
use Inertia\Inertia;
use App\Models\PageTnc;
use App\Models\Product;
use App\Models\Service;
use App\Models\PageHome;
use App\Models\PageAbout;
use App\Models\Portfolio;
use App\Models\UserQuery;
use App\Models\Newsletter;
use App\Models\PageRefund;
use App\Models\PageContact;
use App\Models\PagePrivacy;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Events\ContactFormSubmitted;
use App\Http\Controllers\Controller;

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
        $data = PageHome::whereId(1)->first();
        return Inertia::render('user/pages/home/index', compact( 'services', 'testimonials', 'team', 'clients', 'data'));
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
    
    function product()
    {
        $categories = ProductCategory::whereIsActive(1)->get();
        $data = Product::whereIsActive(1)->get();
        return Inertia::render('user/pages/product/index', compact('categories','data'));
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
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        $data = new UserQuery();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->phone = $request['phone'];
        $data->subject = $request['subject'];
        $data->message = $request['message'];
        $data->save();
        // dd($data);
        event(new ContactFormSubmitted($data));
        return back()->with('success', 'You have successfully submitted the form');
    }

    function newsletter(Request $request)
    {
        $request->validate([
            'email'   => 'required|email|max:255',
        ]);
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
    function faq()
    {
        $faqs = Faq::where('is_active', 1)
            ->with('category')
            ->orderBy('faq_category_id')
            ->get()
            ->groupBy('faq_category_id')
            ->map(function ($items) {
                return [
                    'category_title' => $items->first()->category->title,
                    'faqs' => $items->map(function ($faq) {
                        return [
                            'id'       => $faq->id,
                            'question' => $faq->question,
                            'answer'   => $faq->answer,
                        ];
                    })->values(),
                ];
            });

        $data = $faqs->values();
        // dd($data);
        return Inertia::render('user/pages/faq', compact('data'));
    }
}
