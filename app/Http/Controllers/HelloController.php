<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
   public function about(){
       return view('page.about');
   }
   public function student(){
       return view ('page.student');
   }
   public function write(){
       return view('page.write');
   }
//    Here this section shows the blog posts ============


   public function index(){
       $post=DB::table('posts')
       ->join('categories','posts.category_id','categories.id')
       ->select('posts.*','categories.name','categories.slug')
       ->paginate(2);
    return view('page.index',compact('post'));
}
}
