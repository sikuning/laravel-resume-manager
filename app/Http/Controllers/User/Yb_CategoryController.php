<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = session()->get('id');
        if($request->ajax()){
            $data = Category::where('user',$user)->get();
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
        return view('user.category.index');
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
    public function store(CategoryRequest $request)
    {
        //
        $category = new Category();
        $category->title = $request->title;
        $category->user = session()->get('id');
        $result = $category->save();
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
        $category = Category::where(['id'=>$id])->get();
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //
        $category = Category::where(['id'=>$id])->update([
            "title"=>$request->title,
            "status"=>$request->status,
        ]);
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Category::where('id',$id)->delete();
        return $destroy;
    }
}
