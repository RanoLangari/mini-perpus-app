<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view ('home', ['title' => 'Home']);
    }

    public function about()
    {
        return view ('about', ['title' => 'About']);
    }

    public function contact()
    {
        return view ('contact', ['title' => 'contact']);
    }
}
