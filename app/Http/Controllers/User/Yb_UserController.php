<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\str;
use Illuminate\Support\Carbon;
use Mail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\Preference;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Yb_UserController extends Controller
{
    //
    public function yb_index(Request $request){
        if(!session()->has('username')){
            if($request->input()){
                $request->validate([
                    'email'=>'required',
                    'password'=>'required',
                ]); 

                $user = $request->input('email');
                $pass = $request->input('password');
            // return Hash::make($request->input('password'));
                $login = User::where(['email'=>$request->email])->first();
            
                if(empty($login)){
                    return 'Email Does not Exists';
                }else if($login->status != '1'){
                    return 'Your account is blocked. Contact to Site Administrator for login to your account.';
                }else{
                    if(Hash::check($request->password,$login['password'])){
                        //$user = User::first();
                        $request->session()->put('id',$login->id);
                        $request->session()->put('username',$login->username);
                        $request->session()->put('user_slug',$login->user_slug);
                        return '1';
                    }else{
                        return 'Email and Password does not matched';
                    }
                }
            }else{
                return view('frontend.login');
            }
        }else{
            return redirect('user/my-profile');
        }
	}
    
    public function yb_signup(Request $request){
        if(!session()->has('username')){
            if($request->input()){
                $request->validate([
                    'username'=>'required',
                    'designation'=>'required',
                    'phone'=>'required',
                    'country'=>'required',
                    'email'=>'required|email|unique:users,email',
                    'password'=>'required',
                ]);
                $email_split = explode('@',$request->email);
        
                $user = new User();
                $user->username = $request->input("username");
                $user->user_slug = $email_split[0].uniqid();
                $user->designation = $request->input("designation");
                $user->phone = $request->input("phone");
                $user->country = $request->input("country");
                $user->email = $request->input("email");
                $user->password = Hash::make($request->input("password"));
                $result = $user->save();

                DB::table('hero_section')->insert([
                    'pre_title' => 'Aliquam semper fermentum',
                    'title' => 'Aliquam semper fermentum',
                    'sub_title' => 'Aliquam semper fermentum',
                    'show_portfolio_btn' => '0',
                    'show_contact_btn' => '0',
                    'user' => $user->id,
                ]);


                return $result;
            }else{
                return view('frontend.signup');
            }
        }else{
            return redirect('user/my-profile');
        }
    }

 
    public function yb_profile_settings(){
        $id = session()->get('id');
        $settings = User::where('id',$id)->first();
        $data = Preference::orderBy('order','asc')->get();
        if($settings){
            return view('user.myProfile',['data'=>$settings,'preference'=>$data]);
        }else{
            return abort('404');
        }
    }

    public function yb_update_profile(Request $request){
        if($request->input()){
            // return $request->input();
            $request->validate([
                'username'=> 'required',
                'designation'=> 'required',
                'phone'=> 'required',
                'country'=> 'required',
            ]);

            if($request->show_gender && $request->show_gender == 'on'){
                $show_gender = '1';
            }else{
                $show_gender = '0';
            }

            if($request->show_dob && $request->show_dob == 'on'){
                $show_dob = '1';
            }else{
                $show_dob = '0';
            }

            // Update User Profile Image
            if($request->img != ''){        
                $path = public_path().'/user_profile/';
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
            $id = session()->get('id');
            $update = User::where(['id'=>$id])->update([
                'username'=>$request->username,
                'user_slug'=>Str::slug($request->slug),
                'image'=>$image,
                'designation'=>$request->designation,
                'gender'=>$request->gender,
                'dob'=>$request->dob,
                'phone'=>$request->phone,
                'city'=>$request->city,
                'pincode'=>$request->pincode,
                'state'=>$request->state,
                'show_gender'=>$show_gender,
                'show_dob'=>$show_dob,
                'about_me'=>$request->about_me,
            ]);
            session()->put('username',$request->username);
            return $update;
        }else{
            $id = session()->get('id');
            $user = User::where('id',$id)->first();
            if($user){
                return view('user.editProfile',compact('user'));
            }else{
                return abort('404');
            }
        }
    }

    public function yb_check_user_slug(Request $request){
        $slug = Str::slug($request->slug);
        $user = session()->get('id');
        $check = User::where('user_slug',$slug)->whereNot('id',$user)->count();
        return $check;
    }

    public function yb_show_in_status(Request $request){
        $id = $request->id;
        $status = $request->status;
       
        $response =  Preference::where('id',$id)->update([
            'status'=> $status
        ]);
        return $response;
    }

    public function yb_updatePreferenceOrder(Request $request){
        $list = $request->list;
        foreach($list as $key=>$value){
            $pref = Preference::find($value);
            $pref->order = $key+1;
            $pref->save();
        }
        return '1';

    }

    public function yb_change_password(Request $request){
        if($request->input()){
            $request->validate([
                'password'=> 'required',
                'new'=> 'required',
                'new_confirm'=> 'required',
            ]);

            $get_user = DB::table('users')->where('id',session()->get('id'))->first();

            if(Hash::check($request->password,$get_user->password)){
                DB::table('users')->update([
                    'password'=>Hash::make($request->new)
                ]);
                return '1';
            }else{
                return 'Please Enter Correct Current Password';
            }
        }else{
            return view('user.change-password');
        }
    }
 


    public function yb_contact(Request $request){
        if ($request->ajax()) {
            $user = session()->get('id');
            $data = DB::table('user_contact_message')->where('user',$user)->latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="viewContact btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>';
                        return $btn;
                })
                ->rawColumns(['action'])
                 ->make(true);
        }
        return view('user.contact');
    } 

    public function yb_viewContact_message($id){
        $contact = DB::table('user_contact_message')->where(['id'=> $id])->first();
        $output = '';
            $output .= '<tr>
                            <th>Name:</th>
                            <td scope="row" class="client">'.$contact->name.'</td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td>'.$contact->email.'</td>
                        </tr>
                        <tr>
                            <th>Message :</th>
                            <td>'.htmlspecialchars_decode($contact->message).'</td>
                        </tr>';
        return $output;  
    }

    public function yb_logout(Request $req){
		Auth::logout();
		session()->forget('user');
		session()->forget('username');
		return '1';
	}

    public function yb_layouts(Request $request){
        if($request->input()){
            $id = session()->get('id');
            User::where('id',$id)->update([
                'layout' => $request->layout
            ]);
            return '1';
        }else{
            $id= session()->get('id');
            $layout_count = DB::table('general_settings')->pluck('layouts')->first();
            $user_layout = User::where('id',$id)->pluck('layout')->first();
            return view('user.change-layout',compact('layout_count','user_layout'));
        }
        
    }

    public function yb_forgot_password(Request $request){
        if(!session()->has('user_id')){
            if($request->input()){
                try{
                    $user = User::where('email',$request->email)->first(); 
                    if($user){
                        if($user->status == '0'){
                            return 'Your account is blocked by Site Administrator';
                        }
                        $token = Str::random(40);
                        $domain = URL::to('/');
                        $url = $domain.'/reset-password?token='.$token;

                        $data['url'] = $url;
                        $data['email'] = $request->email;
                        $data['title'] = 'Password Reset';
                        $data['body'] = 'Please click on below link to reset you password.';

                        Mail::send('frontend.mail.forgotPasswordMail',['data'=>$data],function($message) use ($data){
                                $message->to($data['email'])->subject($data['title']);
                        });
                        $dataTime = Carbon::now()->format('Y-m-d H:i:s');
                        PasswordReset::updateOrCreate(
                            ['email' => $request->email],
                            [
                            'email' => $request->email,
                            'token'=> $token,
                            'created_at' => $dataTime
                            ]
                        );
                        return '1'; 
                    }else{
                        return 'Email Does Not Exists!'; 
                    }
                    }catch(\Exception $e){
                        return response()->json(['error',$e->getMessage()]);
                    }
            }else{
                return view('frontend.forgot-password');
            }
        }else{
            return abort('404');
        }
    }

    public function yb_reset_password(Request $request){
        $resetData = PasswordReset::where('token',$request->token)->get();
        if(isset($request->token) && count($resetData) > 0){
            $user = User::where('email',$resetData[0]['email'])->get();
            return view('frontend.reset-password',compact('user'));
        }else{
            return view('404');
        }
    }

    public function yb_reset_passwordUpdate(Request $request){
        $request->validate([
            'password'=> 'required',
            'confirm_password'=> 'required',
        ]);
       
        $data = User::where(['id'=>$request->id])->update([
            "password" => Hash::make($request->input("password")),
        ]);
        $user = User::where('id',$request->id)->first();
        PasswordReset::where('email',$user->email)->delete();
        return '1';
    }

}
