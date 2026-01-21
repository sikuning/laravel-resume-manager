<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Yb_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $data = BlogCategory::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status',function($row){
                    if($row->status == '1'){
                        $status = '<span class="btn btn-xs btn-success">Show</span>';
                    }else{
                        $status = '<span class="btn btn-xs btn-danger">Hide</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editCategory btn btn-success btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm delete-category" data-id="'.$row->id.'">Delete</button>';
                        return $btn;
                    })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryRequest $request)
    {
        $slug = Str::slug($request->title);
        $check_slug = BlogCategory::where('slug',$slug)->count();
        if($check_slug > 0){
            $slug = $slug.'-'.strtotime(date('Y-m-d h:i:s'));
        }

        $blogCategory = new BlogCategory();
        $blogCategory->title = $request->title;
        $blogCategory->slug = $slug;
        $result = $blogCategory->save();
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
        $blogCategory = BlogCategory::where(['id'=>$id])->get();
        return $blogCategory;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryRequest $request, string $id)
    {
        if($request->slug != ''){
            $slug = Str::slug($request->input("slug"));
        }else{
            $slug = Str::slug($request->input("title"));
        }
        $check_slug = BlogCategory::where('slug',$slug)->whereNot('id',$id)->count();
        if($check_slug > 0){
            $slug = $slug.'-'.strtotime(date('Y-m-d h:i:s'));
        }

        $blogCategory = BlogCategory::where(['id'=>$id])->update([
            "title"=>$request->title,
            "slug"=>$request->slug,
            "status"=>$request->status,
        ]);
        return $blogCategory;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = Blog::where('category',$id)->first();
        if(!$check){
            $destroy = BlogCategory::where('id',$id)->delete();
            return $destroy;
        }else{
            return "You won't delete this. This Category used in Blogs.";
        }
    }
}
