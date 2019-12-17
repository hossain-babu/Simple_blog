<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddCategory extends Controller
{
    public function add(){
        return view('page.add');
    }
    public function storecat(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:25|min:4',
            'slug' => 'required|unique:categories|max:25|min:4',
        ]);


        $data =array();
        $data['name']=$request->name;
        $data['slug']=$request->slug;
        $category =DB::table('categories')->insert($data);
        if($category) {
            $notification = array(
                'message'=>'Successfully inserted data!',
                'alert-type'=>'success'
            ); 
            return redirect()->route('all.category')->with($notification);
            
            }else{
                $notification=array(
                    'message'=>'Something went wrong!', 
                    'alert-type'=>'error'
                );

        }   
    }
    public function showall(){
        $category =DB::table('categories')->get();        
        return view('page.all_category',compact('category'));
    }
    public function viewcategory($id){
        $category = DB::table('categories')->where('id',$id)->first();
        return view('page.categoryview')->with('cat',$category);
    }
    public function deletecategory($id){
        $delete = DB::table('categories')->where('id',$id)->delete();
        $notification = array(
            'message'=>'Successfully Category Deleted!',
            'alert-type'=>'success'
        ); 
      return redirect()->route('all.category')->with($notification);
    }
    public function editCategory($id){
        $category = DB::table('categories')->where('id',$id)->first();
        return view('page.editCategory')->with('category',$category);
    }public function updateCategory(request $request , $id){
        
        $validatedData = $request->validate([
            'name' => 'required|max:25|min:4',
            'slug' => 'required|max:25|min:4',
        ]);


        $data =array();
        $data['name']=$request->name;
        $data['slug']=$request->slug;
        $category =DB::table('categories')->where('id',$id)->update($data);
        if($category) {
            $notification = array(
                'message'=>'Successfully Updated data!',
                'alert-type'=>'success'
            ); 
            return redirect()->route('all.category')->with($notification);
            
            }
            else{
                $notification=array(
                    'message'=>'Nothing To Update!', 
                    'alert-type'=>'error'
                );
                return redirect()->route('all.category')->with($notification);
            
        }   
    }

}
