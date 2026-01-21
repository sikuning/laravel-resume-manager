<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Yb_PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Page::orderBy('id','desc')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('show_in_header', function($row){
                    $checked = ($row->show_in_header == '1') ? 'checked' : '';
                    return '<div class="page-checkbox">
                    <input type="checkbox" class="show-in-header" id="head'.$row->id.'" '.$checked.'>
                    <label for="head'.$row->id.'"></label>
                </div>';
                })
                ->editColumn('show_in_footer', function($row){
                    $checked = ($row->show_in_footer == '1') ? 'checked' : '';
                    return '<div class="page-checkbox">
                    <input type="checkbox" class="show-in-footer" id="foot'.$row->id.'" '.$checked.'>
                    <label for="foot'.$row->id.'"></label>
                </div>';
                })
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $status = '<span class="btn btn-xs btn-primary">Active</span>';
                    }else{
                        $status = '<span class="btn btn-xs btn-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="pages/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-page btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['show_in_header','show_in_footer','status','action'])
                ->make(true);
        }
        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $slug = Str::slug($request->title);
        $check_slug = Page::where('page_slug',$slug)->count();
        if($check_slug > 0){
            $slug = $slug.'-'.strtotime(date('Y-m-d h:i:s'));
        }


        $page = new Page();
        $page->page_title = $request->title;
        $page->page_slug = $slug;
        $page->description = htmlspecialchars($request->des);
        $result = $page->save();
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
        $page = Page::where(['id'=>$id])->first();
        return view('admin.pages.edit',['page'=>$page]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, $id)
    {
        //
        if($request->slug != ''){
            $slug = Str::slug($request->input("slug"));
        }else{
            $slug = Str::slug($request->input("title"));
        }
        $check_slug = Page::where('page_slug',$slug)->whereNot('id',$id)->count();
        if($check_slug > 0){
            $slug = $slug.'-'.strtotime(date('Y-m-d h:i:s'));
        }

        $page = Page::where(['id'=>$id])->update([
            "page_title" => $request->title,
            "page_slug"=> $slug,
            "description" => htmlspecialchars($request->des),
            "status" => $request->status,
        ]);
        return $page;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Page::where('id',$id)->delete();
        return  $destroy;
    }

    public function yb_show_in_header(Request $request){
        $id = $request->id;
        $status = $request->status;

        $response = Page::where('id',$id)->update([
            'show_in_header'=> $status
        ]);
        return $response;
    }

    public function yb_show_in_footer(Request $request){
        $id = $request->id;
        $status = $request->status;

        $response = Page::where('id',$id)->update([
            'show_in_footer'=> $status
        ]);
        return $response;
    }
}
