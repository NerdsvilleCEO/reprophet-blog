<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use JavaScript;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::with('user')->get();
        JavaScript::put([
            'posts' => $posts
        ]);
        return view('home');
    }
}
