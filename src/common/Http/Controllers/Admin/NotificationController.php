<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index() {
        $data = $this->user()->notifications()->paginate(15);
        return $this->render('admin/resources/notification/index', compact('data'));
    }
    

    public function show($id) {
        $notification = $this->user()->notifications()->where('id', $id)->first();
        
        if ($notification && $notification->read_at === null) {
            $notification->markAsRead();
        }
        if (isset($notification['data']['url'])) {
            return redirect()->to($notification['data']['url']);
        }
        return redirect()->back();
    }

    protected function user()
    {
       /** @var \App\Models\Admin $user */
        $user = Auth::guard('admin')->user();
        return $user;
    }
}
