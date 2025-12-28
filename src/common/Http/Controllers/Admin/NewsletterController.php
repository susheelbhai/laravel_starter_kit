<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    function index() {
        $data = Newsletter::latest()->get();
        return $this->render('admin/resources/newsletter/index', compact('data'));
    }
}
