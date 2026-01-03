<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        return $this->render('partner/dashboard', [
            'submitUrl' => route('partner.login'),
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
        ]);
    }
}
