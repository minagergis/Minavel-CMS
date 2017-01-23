<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function getHome()
    {
        // $slider = Post::where('post_status', 'publish')->where('post_type', 'slider')->orderby('id', 'DESC')->take(5)->get();
        
        // $team = Post::where('post_status', 'publish')->where('post_type', 'team')->orderby('id', 'DESC')->take(9)->get();
        
        // $testimonials = Post::where('post_status', 'publish')->where('post_type', 'testimonial')->orderby('id', 'DESC')->take(6)->get();
        
        // $clients = Post::where('post_status', 'publish')->where('post_type', 'client')->orderby('id', 'DESC')->take(6)->get();
        
        // $portfolio = Post::where('post_status', 'publish')->where('post_type', 'portfolio')->orderby('id', 'DESC')->take(12)->get();
        
        // $recent_posts = Post::where('post_status', 'publish')->where('post_type', 'post')->orderby('id', 'DESC')->take(5)->get();

        return view('welcome');
    }
    
    public function getAbout()
    {
        return view('sections.about');
    }

    public function getGallery()
    {
        $gallery = Post::where('post_status', 'publish')->where('post_type', 'gallery')->take(15)->paginate();

        return view('sections.gallery', compact('gallery'));
    }
    
 
}
