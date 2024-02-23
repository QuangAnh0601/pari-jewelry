<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function contact ()
    {
        return view('static-pages.contact');
    }

    public function about ()
    {
        return view('static-pages.about');
    }

    public function privacy ()
    {
        return view('static-pages.privacy');
    }
}
