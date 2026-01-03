<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        return $this->render('seller/dashboard', [
            'submitUrl' => route('seller.login'),
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
        ]);
    }
}
