<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class postController extends Controller
{
    public function write()
    {
        $category = DB::table('categories')->get();
        return view('page.write', compact('category'));
    }
    public function storepost(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data=array();
        $data['title']=$request->title;
        $data['category_id']=$request->category_id;
        $data['details']=$request->details;
        
        $image=$request->file('image');
        if($image){
            $image_name =hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/frontend/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            DB::table('posts')->insert($data);
            $notification = array(
                'message'=>'Successfully Post Inserted!',
                'alert-type'=>'success'
            ); 
            return redirect()->route('all.post')->with($notification);


        }else{
         DB::table('posts')->insert($data);
         $notification = array(
            'message'=>'Successfully Post Inserted!',
            'alert-type'=>'success'
        ); 
        return redirect()->route('all.post')->with($notification);
        }
    }
    public function allpost(){
        // $post = DB::table('posts')->get();
        $post=DB::table('posts')
        ->join('categories','posts.category_id','categories.id')
        ->select('posts.*','categories.name')
        ->get();
        return view('page.allpost',compact('post'));
    }
    public function viewpost($id){
            $post=DB::table('posts')
              ->join('categories','posts.category_id','categories.id')
              ->select('posts.*','categories.name')
              ->where('posts.id',$id)
              ->first();;
            return view('page.viewpost',compact('post'));
    }
    public function editpost($id){
        $category=DB::table('categories')->get();
        $post=DB::table('posts')->where('id',$id)->first();
        return view('page.editpost',compact('category','post'));
    }
    public function updatepost(Request $request, $id){
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'details' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data=array();
        $data['title']=$request->title;
        $data['category_id']=$request->category_id;
        $data['details']=$request->details;
        
        $image=$request->file('image');
        if($image){
            $image_name =hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/frontend/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            unlink($request->old_photo);
            DB::table('posts')->where('id',$id)->update($data);
            $notification = array(
                'message'=>'Successfully Post Updated!',
                'alert-type'=>'success'
            ); 
            return redirect()->route('all.post')->with($notification);


        }else{
        $data['image']=$request->old_photo;
         DB::table('posts')->where('id',$id)->update($data);
         $notification = array(
            'message'=>'Successfully Post Updated!',
            'alert-type'=>'success'
        ); 
        return redirect()->route('all.post')->with($notification);
        } 
    }
    public function deletepost($id){
        $post=DB::table('posts')->where('id',$id)->first();
        $image=$post->image; 
        $delete=DB::table('posts')->where('id',$id)->delete();
        if($delete){
            unlink($image);
            $notification = array(
                'message'=>'Successfully Post Deleted!',
                'alert-type'=>'success'
            );
             return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification); 
        }
        
    }
}
