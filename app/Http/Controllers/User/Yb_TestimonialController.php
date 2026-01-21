<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = session()->get('id');
        if ($request->ajax()) {
            $data = Testimonial::where('user',$user)->latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image',function($row){
                    if($row->client_image != ''){
                        $img = '<div class="d-flex flex-row">
                                    <img src="'.asset("public/testimonial/".$row->client_image).'" class="mr-2" width="40px">
                                    <span class="align-self-center">'.$row->client_name.' <small>('.$row->client_designation.')</small></span>
                                </div>';
                    }else{
                        $img = '<div class="d-flex flex-row">
                                    <img src="'.asset("public/testimonial/default.png").'" class="mr-2" width="40px">
                                    <span class="align-self-center">'.$row->client_name.' <small>('.$row->client_designation.')</small></span>
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
                     $btn = '<a href="testimonial/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-testimonial btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                     return $btn;
                 })
                 ->rawColumns(['image','status','action'])
                 ->make(true);
        }
        return view('user.testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        //
        if($request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('testimonial'),$image);
        }else {
            $image = "";
        }

        $testimonial = new Testimonial();
        $testimonial->client_image = $image;
        $testimonial->client_name = $request->client_name;
        $testimonial->client_designation = $request->designation;
        $testimonial->feedback = $request->des;
        $testimonial->user = session()->get('id');
        $result = $testimonial->save();
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
        $testimonial = Testimonial::where('id',$id)->first();
        return view('user.testimonial.edit',['testimonial'=>$testimonial]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialRequest $request, string $id)
    {
        //
          // Update Testimonial Image
          if($request->img != ''){        
            $path = public_path().'/testimonial/';
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

        $testimonial = Testimonial::where(['id'=>$id])->update([
            "client_name" => $request->client_name,
            "client_designation" => $request->designation,
            "client_image" => $image,
            "feedback" => $request->des,
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
        $imagePath = Testimonial::where('id',$id)->pluck('client_image')->first();
        if($imagePath){
            $filePath = public_path().'/testimonial/'.$imagePath;
            File::delete($filePath);
        }
        $destroy = Testimonial::where('id',$id)->delete();
        return  $destroy;
    }
}
