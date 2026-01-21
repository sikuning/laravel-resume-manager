<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = session()->get('id');
        if($request->ajax()){
            $data = Skill::where('user',$user)->latest('id')->get();
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
                    $btn = '<a href= "javascript:void(0)" data-id="'.$row->id.'" class="editSkill btn btn-success btn-sm">Edit</a>  <button type="button" value="delete" class="btn btn-danger btn-sm deleteSkill" data-id="'.$row->id.'">Delete</button>';
                        return $btn;
                    })
                ->rawColumns(['status','action'])
                ->make(true);
        }
        return view('user.skill.index');
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
    public function store(SkillRequest $request)
    {
        //
        $skill = new Skill();
        $skill->title = $request->title;
        $skill->user = session()->get('id');
        $skill->percent = $request->percent;
        $result = $skill->save();
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
        $skill = Skill::where(['id'=>$id])->get();
        return $skill;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillRequest $request, string $id)
    {
        //
        $skill = Skill::where(['id'=>$id])->update([
            "title"=>$request->title,
            "percent"=>$request->percent,
            "status" => $request->status,
        ]);
        return $skill;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $destroy = Skill::where('id',$id)->delete();
        return $destroy;
    }
}
