<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get all posts to list them for the user
        $posts = Post::all();

        // view home page with all posts from database.
        return view('home',["msg" => "I am user home"])->with('posts', $posts);
    }

    public function Adminindex()
    {
        // get all posts to list them for the user
        $posts = Post::all();

        // view home page with all posts from database.
        return view('admin-home',["msg" => "I am admin home"])->with('posts', $posts);
    }



}
