<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();
        $new_posts = Post::orderBy('created_at', 'desc')->take(6)->get();
        return view('index',compact('posts','tags','new_posts'));
    }

    public function contract()
    {
        $posts = Post::all();
        $tags = Tag::all();
        $new_posts = Post::orderBy('created_at', 'desc')->take(6)->get();
        return view('layouts.contract',compact('posts','tags','new_posts'));
    }

    public function feature()
    {
        $posts = Post::all();
        $tags = Tag::all();
        $new_posts = Post::orderBy('created_at', 'desc')->take(6)->get();
        return view('layouts.feature',compact('posts','tags','new_posts'));
    }

    public function blog()
    {
        $posts = Post::all();
        $tags = Tag::all();
        $new_posts = Post::orderBy('created_at', 'desc')->take(6)->get();
        return view('layouts.blog',compact('posts','tags','new_posts'));
    }

    public function aboutus()
    {
        $posts = Post::all();
        $tags = Tag::all();
        $new_posts = Post::orderBy('created_at', 'desc')->take(6)->get();
        return view('layouts.aboutus',compact('posts','tags','new_posts'));
    }

    public function admin()
    {
        return view('layouts.admin');
    }
}
