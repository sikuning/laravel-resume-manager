<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UserServiceRequest;
use App\Models\UserService;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = session()->get('id');
        if ($request->ajax()) {
            $data = UserService::where('user',$user)->latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image',function($row){
                    if($row->image != ''){
                        $img = '<div class="">
                                    <img src="'.asset("public/user_service/".$row->image).'" class="mr-2" width="70px">
                                </div>';
                    }else{
                        $img = '<div class="">
                                    <img src="'.asset("public/user_service/default.png").'" class="mr-2" width="70px">
                                </div>';
                    }
                    return $img;
                })
                ->editColumn('icon',function($row){
                    if($row->icon != ''){
                        return '<i class="'.$row->icon.'"></i>';
                    }else{
                        return '';
                    }
                })
                ->editColumn('status',function($row){
                     if($row->status == '1'){
                         $status = '<span class="btn btn-xs btn-success">Show</span>';
                     }else{
                         $status = '<span class="btn btn-xs btn-danger">Hide</span>';
                     }
                     return $status;
                })
                ->addColumn('action', function($row){
                     $btn = '<a href="services/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-service btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                     return $btn;
                 })
                 ->rawColumns(['image','icon','status','action'])
                 ->make(true);
        }
        return view('user.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserServiceRequest $request)
    {
        //
        if($request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('user_service'),$image);
        }else {
            $image = "";
        }

        $userService = new UserService();
        $userService->image = $image;
        $userService->icon = $request->icon;
        $userService->title = $request->title;
        $userService->description = $request->des;
        $userService->user = session()->get('id');
        $result = $userService->save();
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
        $userService = UserService::where('id',$id)->first();
        return view('user.services.edit',['service'=>$userService]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // Update User Service Image
        if($request->img != ''){        
            $path = public_path().'/user_service/';
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

        $userService = UserService::where(['id'=>$id])->update([
            "title" => $request->title,
            "image" => $image,
            "icon" => $request->icon,
            "description" => $request->des,
            "status" => $request->status,
        ]);
        return '1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $imagePath = UserService::select('image')->where('id',$id)->first();
        $filePath = public_path().'/user_service/'.$imagePath->image;
        File::delete($filePath);
        $destroy = UserService::where('id',$id)->delete();
        return  $destroy;
    }
}
