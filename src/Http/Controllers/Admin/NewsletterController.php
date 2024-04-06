<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    function index() {
        return view('separate.admin.resources.newsletter.index');
    }
}
