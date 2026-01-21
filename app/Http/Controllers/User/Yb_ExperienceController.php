<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class Yb_ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = session()->get('id');
        if ($request->ajax()) {
            $data = Experience::where('user',$user)->latest('id')->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('from_year',function($row){
                    $duration = date('M, Y',strtotime($row->from_year));
                     if($row->to_year != 'current'){
                        $duration .= ' - '.date('M, Y',strtotime($row->to_year));
                     }else{
                        $duration .= ' - '.$row->to_year;
                     }
                     return $duration;
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
                     $btn = '<a href="experience/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-experience btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                     return $btn;
                 })
                 ->rawColumns(['status','action'])
                 ->make(true);
        }
        return view('user.experience.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request)
    {
        //
        if($request->current && $request->current == 'on'){
            $to_year = 'current';
        }else{
            $to_year = $request->to_year;
        }

        $experience = new Experience();
        $experience->designation = $request->title;
        $experience->company = $request->company;
        $experience->from_year = $request->from_year;
        $experience->to_year = $to_year;
        $experience->description = $request->des;
        $experience->user = session()->get('id');
        $result = $experience->save();
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
        $experience = Experience::where('id',$id)->first();
        return view('user.experience.edit',['experience'=>$experience]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, string $id)
    {
        if($request->current && $request->current == 'on' || $request->to_year == ''){
            $to_year = 'current';
        }else{
            $to_year = $request->to_year;
        }

        $experience = Experience::where(['id'=>$id])->update([
            "designation" => $request->title,
            "company" => $request->company,
            "from_year" => $request->from_year,
            "to_year" => $to_year,
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
        $destroy = Experience::where('id',$id)->delete();
        return  $destroy;
    }
}
