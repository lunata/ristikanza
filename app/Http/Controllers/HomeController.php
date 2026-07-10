<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    /**
     * Show the start page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
        //        return view('welcome', compact());
    }

    public function page(string $page)
    {
        if (View::exists('pages.' . $page)) {
            return view('pages.' . $page);
        }
        print "This page is not found.";
    }

}
