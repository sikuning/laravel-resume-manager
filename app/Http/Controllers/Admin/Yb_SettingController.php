<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;

class Yb_SettingController extends Controller
{

    public function yb_general_settings(Request $request){
    
        if($request->input()){
            // return $request->input();
            $request->validate([
                'logo'=> 'image|mimes:jpg,jpeg,png,svg',
                'com_name'=> 'required',
                'com_email'=> 'required',
                'com_phone'=> 'required',
                'address'=> 'required',
                'footer_copyright'=> 'required',
            ]);

            if($request->logo != ''){        
                $path = public_path().'/frontend/images/';

                //code for remove old file
                if($request->old_logo != ''  && $request->old_logo != null){
                    $file_old = $path.$request->old_logo;
                    if(file_exists($file_old)){
                        unlink($file_old);
                    }
                }

                //upload new file
                $file = $request->logo;
                $filename = rand().$file->getClientOriginalName();
                $file->move($path, $filename);
            }else{
                $filename = $request->old_logo;
            }

            $update = DB::table('general_settings')->update([
                'com_logo'=>$filename,
                'com_name'=>$request->com_name,
                'com_email'=>$request->com_email,
                'com_phone'=>$request->com_phone,
                'address'=>$request->address,
                'footer_copyright'=>$request->footer_copyright,
                
            ]);
            return $update;
        }else{
            $settings = DB::table('general_settings')->get();
            return view('admin.settings.general',['data'=>$settings]);
        }
    }

    public function yb_profile_settings(Request $request){
        if($request->input()){
            $request->validate([
                'admin_name'=> 'required',
                'admin_email'=> 'required|email:rfc',
                'username'=> 'required',
            ]);

            $update = DB::table('admin')->update([
                'admin_name'=>$request->admin_name,
                'admin_email'=>$request->admin_email,
                'username'=>$request->username,
            ]);
            return $update;

        }else{
            $settings = DB::table('admin')->get();
            return view('admin.settings.profile',['data'=>$settings]);
        }
    }

    public function yb_user(Request $request){
        if ($request->ajax()) {
            $data = User::orderBy('id','desc')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($row){
                    if($row->image != ''){
                        return '<img src="'.asset('public/user_profile/'.$row->image).'" height="40px">';
                    }else{
                        return '<img src="'.asset('public/user_profile/default.png').'" height="40px">';
                    }
                })
                ->addColumn('join', function($row){
                    return date('d M, Y',strtotime($row->created_at));
                })
                ->editColumn('status', function($row){
                    if($row->status == '0'){
                        return '<span class="badge badge-warning">Blocked</span>';
                    }else{
                        return '<span class="badge badge-success">Active</span>';
                    }
                })
                ->addColumn('action', function($row){
                    if($row->status == '0'){
                        return '<button class="btn btn-success btn-sm changeUserStatus" data-status="1" data-id="'.$row->id.'">Unblock</button> <a href="'.url('/'.$row->user_slug).'" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>';
                    }else{
                        return '<button class="btn btn-sm btn-warning changeUserStatus" data-status="0" data-id="'.$row->id.'">Block</button> <a href="'.url('/'.$row->user_slug).'" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>';
                    }
                    
                })
                ->rawColumns(['image','join','status','action'])
                ->make(true);
        }
        return view('admin.users'); 
    }

    public function yb_changeUser_status(Request $request){
        $id = $request->id;
        $status = $request->status;

        $user = User::where('id',$id)->update([
            'status' => $status
        ]);
        return $user;
    }

    public function yb_contact(Request $request){
        if ($request->ajax()) {
            $data = DB::table('contact_message')->orderBy('id','desc')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="viewContact btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.contact'); 
    }

    public function yb_view_contactMessage($id){
        //
        $contact = DB::table('contact_message')->where(['id'=> $id])->first();
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
                            <th>Phone :</th>
                            <td>'.$contact->phone.'</td>
                        </tr>
                        <tr>
                            <th>Message :</th>
                            <td>'.htmlspecialchars_decode($contact->message).'</td>
                        </tr>';
        return $output;      
    }

    public function yb_change_password(Request $request){
        
        if($request->input()){
            $request->validate([
                'password'=> 'required',
                'new'=> 'required',
                'new_confirm'=> 'required',
            ]);

            $get_admin = DB::table('admin')->first();

            if(Hash::check($request->password,$get_admin->password)){
                DB::table('admin')->update([
                    'password'=>Hash::make($request->new)
                ]);
                return '1';
            }else{
                return 'Please Enter Correct Current Password';
            }
        }
    }

    public function yb_social_settings(Request $request){
        if($request->input()){

            $update = DB::table('social-setting')->update([
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'instagram'=>$request->instagram,
                'you_tube'=>$request->you_tube,
            ]);
            return $update;

        }else{
            $settings = DB::table('social-setting')->get();
            return view('admin.settings.social',['data'=>$settings]);
        }
    }

    public function yb_banner_settings(Request $request){

        if($request->input()){
           // return $request->input();
            $request->validate([
                'image'=> 'image|mimes:jpg,jpeg,png,svg',
            ]);

            if($request->image != ''){        
                $path = public_path().'/banner/';

                //code for remove old file
                if($request->old_image != ''  && $request->old_image != null){
                    $file_old = $path.$request->old_image;
                    if(file_exists($file_old)){
                        unlink($file_old);
                    }
                }

                //upload new file
                $file = $request->image;
                $filename = rand().'.'.$file->getClientOriginalExtension();
                $file->move($path, $filename);
            }else{
                $filename = $request->old_image;
            }

            $update = DB::table('banner_settings')->update([
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
                'image'=>$filename,
                
            ]);
            return $update;
        }else{
            $settings = DB::table('banner_settings')->first();
            return view('admin.settings.banner',['banner'=>$settings]);
        }
    }
}
