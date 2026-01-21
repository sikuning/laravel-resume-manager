<?php

namespace App\Http\Controllers;

use App\Models\AdminService;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class Yb_HomeController extends Controller
{
    public function yb_index(){
        $banner = DB::table('banner_settings')->first();
        $blogs = Blog::with('blog_category')->where('status','1')->limit('6')->latest()->get();
        $services = AdminService::where('status','1')->get();
        $layouts_count = DB::table('general_settings')->pluck('layouts')->first();
        return view('frontend.index',compact('banner','services','blogs','layouts_count'));
    }

    public function yb_contact(Request $request){
        if($request->input()){
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'message' => 'required',
            ]);

            $save = DB::table('contact_message')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
            ]);
            return $save;
        }else{
            return view('frontend.contact');
        }
    }

    public function yb_blog(){
        Paginator::useBootstrapFive();
        $blogs = Blog::with('blog_category')->where('status','1')->latest()->paginate('9');
        return view('frontend.blog',compact('blogs'));
    }

    public function yb_category_blog($slug){
        Paginator::useBootstrapFive();
        $category = BlogCategory::where('slug',$slug)->first();
        if($category){
            $blogs = Blog::with('blog_category')->where(['category'=>$category->id,'status'=>'1'])->paginate('9');
            return view('frontend.category_blog',compact('blogs','category'));
        }else{
            return abort('404');
        }
    }

    public function yb_single_blog($slug){
        $blog = Blog::with('blog_category')->where(['slug'=>$slug,'status'=>'1'])->first();
        $latest = Blog::where(['status'=>'1'])->whereNotIn('id',[$blog->id])->limit('5')->orderBy('id','desc')->get();
        $categories = BlogCategory::withCount('blogs')->where('status','1')->get();
        if($blog){
            return view('frontend.single_blog',compact('blog','latest','categories'));
        }else{
            return abort('404');
        }
    }

    public function yb_layouts(){
        $layouts_count = DB::table('general_settings')->pluck('layouts')->first();
        return view('frontend.layouts',compact('layouts_count'));
    }

    public function yb_custom_page($slug){
        $page = Page::where('page_slug',$slug)->first();
        if($page){
            return view('frontend.custom',compact('page'));
        }else{
            return abort('404');
        }
    }
}
