<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Visitor;


class BlogController extends Controller
{

              public function count()
              {
                            return response()->json([
                                          'total' => Visitor::count(),
                                          'today' => Visitor::whereDate('created_at', now())->count(),
                            ]);
              }
}
