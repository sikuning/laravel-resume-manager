<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Yb_HeroSectionController extends Controller
{
    public function index(Request $request){
        if($request->input()){
            $request->validate([
                'image'=> 'mime:jpg,jpeg,png',
            ]);

            if($request->contact_btn && $request->contact_btn == 'on'){
                $contact_btn = '1';
            }else{
                $contact_btn = '0';
            }

            if($request->portfolio_btn && $request->portfolio_btn == 'on'){
                $portfolio_btn = '1';
            }else{
                $portfolio_btn = '0';
            }

            // Update User Profile Image
            if($request->img != ''){        
                $path = public_path().'/hero-section/';
                //code for remove old file
                if($request->old_img != ''  && $request->old_img != null){
                    $file_old = $path.$request->old_img;
                    if(file_exists($file_old)){
                        unlink($file_old);
                    }
                }
                //upload new file
                $file = $request->img;
                $image = rand().$request->img->getClientOriginalName();
                $file->move($path, $image);
            }else{
                $image = $request->old_img;
            }
            $user = session()->get('id');
            $update = DB::table('hero_section')->where('user',$user)->update([
                'pre_title'=>$request->pre_title,
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
                'image'=>$image,
                'show_contact_btn'=>$contact_btn,
                'show_portfolio_btn'=>$portfolio_btn,
            ]);
            return $update;
        }else{
            $user = session()->get('id');
            $data = DB::table('hero_section')->where('user',$user)->first();
            return view('user.hero-section',compact('data'));
        }
    }
}
