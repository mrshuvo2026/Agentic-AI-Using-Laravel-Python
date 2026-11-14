<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $name = 'Shuvo';
        return view('about', compact('name'));
    }
}