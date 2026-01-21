<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use App\Models\Category;
use App\Models\Portfolio;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = session()->get('id');
        if ($request->ajax()) {
            $data = Portfolio::with('cat_name')->where('user',$user)->latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image',function($row){
                    if($row->image != ''){
                        $img = '<div class="d-flex flex-row">
                                    <img src="'.asset("public/portfolio/".$row->image).'" class="mr-2" width="70px">
                                    <span class="align-self-center">'.$row->title.'</span>
                                </div>';
                    }else{
                        $img = '<div class="d-flex flex-row">
                                    <img src="'.asset("public/portfolio/default.png").'" class="mr-2" width="70px">
                                    <span class="align-self-center">'.$row->title.'</span>
                                </div>';
                    }
                    return $img;
                })
                ->editColumn('cat_name',function($row){
                     return $row->cat_name->title;
                })
                ->editColumn('status',function($row){
                     if($row->status == '1'){
                         $status = '<span class="btn btn-xs btn-success">Show</span>';
                     }else{
                         $status = '<span class="btn btn-xs btn-danger">Hide</span>';
                     }
                     return $status;
                })
                // ->addColumn('categories', function($row){
                //     return $row->category->title;
                // })
                ->addColumn('action', function($row){
                     $btn = '<a href="portfolio/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-portfolio btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                     return $btn;
                 })
                 ->rawColumns(['image','status','action'])
                 ->make(true);
        }

        return view('user.portfolio.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = session()->get('id');
        $category = Category::where('user',$user)->get();
        return view('user.portfolio.create',['category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PortfolioRequest $request)
    {
        //
        if($request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('portfolio'),$image);
        }else {
            $image = "";
        }

        $portfolio = new Portfolio();
        $portfolio->image = $image;
        $portfolio->title = $request->title;
        $portfolio->category = $request->category;
        $portfolio->description = $request->des;
        $portfolio->link = $request->link;
        $portfolio->user = session()->get('id');
        $result = $portfolio->save();
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
        $user = session()->get('id');
        $category = Category::where('user',$user)->get();
        $portfolio = Portfolio::where('id',$id)->first();
        return view('user.portfolio.edit',['portfolio'=>$portfolio,'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PortfolioRequest $request, string $id)
    {
        //
           // Update Portfolio Image
           if($request->img != ''){        
            $path = public_path().'/portfolio/';
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

        $portfolio = Portfolio::where(['id'=>$id])->update([
            "title" => $request->title,
            "image" => $image,
            "category" => $request->category,
            "link" => $request->link,
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
        $destroy = Portfolio::where('id',$id)->delete();
        return  $destroy;
    }
}
