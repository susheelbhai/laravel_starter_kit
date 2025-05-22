<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\BlogView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index() {
        $data = Blog::whereIsActive(1)->get();
        return Inertia::render('user/pages/blog/index', compact('data'));
    }
    public function show(Request $request, $slug) {
        $data = Blog::whereSlug($slug)->whereIsActive(1)->firstOrFail();
        $comments = BlogComment::whereBlogId($data['id'])->with('user')->latest()->get();
        BlogView::create(
            [
                'blog_id' => $data['id'],
                'ip_address'=> $request->ip()
            ]
        );
        return Inertia::render('user/pages/blog/detail', compact('data', 'comments'));
    }
    public function postComment(Request $request, $id) {
        if (Auth::check('web')) {
            $user = Auth::user();
        } else {
            $user = User::wherePhone($request['phone'])->first();
            if ($user == null) {
                $user = User::updateOrCreate(
                    ['phone' => $request['phone']],
                    [
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'password' => Hash::make(rand(11111111,88888888)),
                        'profile_pic' => 'images/profile_pic/dummy.png',
                    ]
                );
            }
            Auth::login($user, 'web');
        }
        $comment = new BlogComment();
        $comment->blog_id = $id;
        $comment->user_id = $user['id'];
        $comment->message = $request['comment'];
        DB::beginTransaction();
        try {
            $comment->save();
            DB::commit();
            return back()->with('success', 'comment has been submitted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        
    }
}
