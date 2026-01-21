<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSocialRequest;
use App\Models\UserSocial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Yb_SocialSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $user = session()->get('id');
            $data = UserSocial::where('user',$user)->latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('icon', function($row){
                    if($row->icon != ''){
                        $icon = '<span><i class="'.$row->icon.'"></i></span>';
                    }else{
                        $icon = '<span><i class=""></i></span>';
                    }
                    return $icon;
                })
                ->editColumn('status',function($row){
                     if($row->status == '1'){
                         $status = '<span class="btn btn-xs btn-success">Active</span>';
                     }else{
                         $status = '<span class="btn btn-xs btn-danger">Inactive</span>';
                     }
                     return $status;
                })
                ->addColumn('action', function($row){
                     $btn = '<a href="social-settings/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-userSocial btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                     return $btn;
                 })
                 ->rawColumns(['icon','status','action'])
                 ->make(true);
        }
        return view('user.socialSetting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.socialSetting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserSocialRequest $request)
    {
        //
        $userSocial = new UserSocial();
        $userSocial->user = session()->get('id');
        $userSocial->title = $request->input('title');
        $userSocial->url = $request->input('url');
        $userSocial->icon = $request->input('icon');
        $userSocial->status = $request->input('status');
        $result = $userSocial->save();
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $userSocial = UserSocial::where(['id'=>$id])->first();
        return view('user.socialSetting.edit',['social'=>$userSocial]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserSocialRequest $request, string $id)
    {
        //
        $userSocial = UserSocial::where(['id'=>$id])->update([
            'title'=>$request->input('title'),
            'url'=>$request->input('url'),
            'icon'=>$request->input('icon'),
            'status'=>$request->input('status'),
        ]);
        return $userSocial;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = UserSocial::where('id',$id)->delete();
        return $destroy;
    }
}
