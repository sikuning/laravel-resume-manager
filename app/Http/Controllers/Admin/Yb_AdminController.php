<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\AdminService;
use App\Models\Blog;
use App\Models\User;
use App\Models\Page;
use Illuminate\Http\Request;

class Yb_AdminController extends Controller
{
    //
  public function yb_index(Request $request){
    if($request->input()){
      $request->validate([
        'username'=>'required',
        'password'=>'required',
      ]); 
    // return Hash::make($request->input('password'));
      $login = Admin::where(['username'=>$request->username])->pluck('password')->first();

      if(empty($login)){
        return response()->json(['username'=>'Username Does not Exists']);
      }else{
        if(Hash::check($request->password,$login)){
          $admin = Admin::first();
          $request->session()->put('admin','1');
          $request->session()->put('admin_name',$admin->admin_name);
          return '1';
        }else{
          return response()->json(['password'=>'Username and Password does not matched']);
        }
      }
      }else{
      return view('admin.admin');
    }
  }

  public function yb_dashboard(){
    $users = User::count();
    $services = AdminService::count();
    $blogs = Blog::count();
    $pages = Page::count();
		return view('admin.dashboard',compact('users','services','blogs','pages'));
  }

  public function yb_contact(){
    return view('admin.contact');
  } 

  public function yb_logout(Request $req){
		Auth::logout();
		session()->forget('admin');
		session()->forget('username');
		return '1';
	}
}
