<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    function index() {
        $data = Newsletter::with('status')->latest()->get();
        return Inertia::render('admin/resources/newsletter/index', compact('data'));
    }
}
