<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoloController extends Controller
{
    public function contact(){
        return view('contact.contact');
    }
    public function blog(){
        return view('blog');
    }
}
