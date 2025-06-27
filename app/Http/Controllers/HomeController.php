<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $categories = Category::all();
        // $books = Book::with(['user', 'category']);

        // if (request('filter') != 'all') {
        //     if (request('filter')) {
        //         $books->where('category_id', request('filter'));
        //     }
        // }

        return view(
            'home'
            // , ['books' => $books->get(), 'categories' => $categories]
        );
    }
}
