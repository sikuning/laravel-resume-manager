<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSocial;
use App\Models\Skill;
use App\Models\UserService;
use App\Models\Experience;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class Yb_ProfileController extends Controller
{
    public function yb_home($slug){
        $preferences = Preference::where('status','1')->orderBy('order','asc')->get();
        $user = User::where('user_slug',$slug)->first();
        if($user){
            $social_links = UserSocial::where(['user'=>$user->id,'status'=>'1'])->get();
            $skills = Skill::where(['status'=>'1','user'=>$user->id])->get();
            $services = UserService::where(['status'=>'1','user'=>$user->id])->latest()->get();
            $experience = Experience::where(['status'=>'1','user'=>$user->id])->latest()->get();
            $portfolio_category = Category::withCount('posts')->where(['status'=>'1','user'=>$user->id])->get();
            $portfolios = Portfolio::where(['status'=>'1','user'=>$user->id])->get();
            $testimonials = Testimonial::where(['status'=>'1','user'=>$user->id])->get();
            $hero_section = DB::table('hero_section')->where('user',$user->id)->first();
            return view('templates.'.$user->layout.'.layout',compact('user','preferences','social_links','skills','services','experience','portfolio_category','portfolios','testimonials','hero_section'));
        }else{
            return abort('404');
        }
    }

    public function yb_saveContact_message(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        return DB::table('user_contact_message')->insert([
            'user' => $request->user,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
    }

    public function yb_show_project(Request $request,$id){
        $project = Portfolio::where('id',$id)->first();
        return view('templates.project-modal',compact('project'));
    }
}
