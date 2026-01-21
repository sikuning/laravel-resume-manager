<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AdminServiceRequest;
use App\Models\AdminService;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;


class Yb_ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = AdminService::latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image',function($row){
                    if($row->image != ''){
                        $img = '<div class="d-flex flex-row">
                                    <img src="'.asset("public/admin_service/".$row->image).'" class="mr-2" width="70px">
                                    <span class="align-self-center">'.$row->title.'</span>
                                </div>';
                    }else{
                        $img = '<div class="d-flex flex-row">
                                    <img src="'.asset("public/admin_service/default.png").'" class="mr-2" width="70px">
                                    <span class="align-self-center">'.$row->title.'</span>
                                </div>';
                    }
                    return $img;
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
                 ->rawColumns(['image','status','action'])
                 ->make(true);
        }
      
        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminServiceRequest $request)
    {
        

        if($request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('admin_service'),$image);
        }else {
            $image = "";
        }

        $adminService = new AdminService();
        $adminService->image = $image;
        $adminService->title = $request->title;
        $adminService->description = $request->des;
        $result = $adminService->save();
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
        $adminService = AdminService::where('id',$id)->first();
        return view('admin.services.edit',['service'=>$adminService]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:admin_service,title,'.$id.',id'
        ]);
         // Update Admin Service Image
         if($request->img != ''){        
            $path = public_path().'/admin_service/';
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

        $adminService = AdminService::where(['id'=>$id])->update([
            "title" => $request->title,
            "image" => $image,
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
        $imagePath = AdminService::select('image')->where('id',$id)->first();
        $filePath = public_path().'/admin_service/'.$imagePath->image;
        if($imagePath->image != ''){
            File::delete($filePath);
        }
        $destroy = AdminService::where('id',$id)->delete();
        return  $destroy;
    }
}
