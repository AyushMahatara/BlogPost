<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_approved', true)->with('category', 'tags')->get(); // Fetch approved posts
        return view('homePage', compact('posts')); // Assuming there is a home.blade.php view file
    }
}
