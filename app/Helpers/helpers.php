<?php
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;

if(! function_exists('site_settings')){
    function site_settings(){
        $siteInfo = DB::table('general_settings')->first();
        return $siteInfo;
    }
}
if(! function_exists('social_links')){
    function social_links(){
        return DB::table('social-setting')->first();
    }
}
if(! function_exists('custom_pages')){
    function custom_pages(){
        return DB::table('pages')->where('status','1')->orderBy('id','desc')->get();
    }
}

// if(! function_exists('user_detail')){
//     function user_detail($user){
//         return User::where('user_slug',$user)->first();;
//     }
// }


?>