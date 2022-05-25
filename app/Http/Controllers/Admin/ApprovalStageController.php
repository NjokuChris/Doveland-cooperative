<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approval_process_type;
use App\Models\Approval_stages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalStageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['approval_stages'] = Approval_stages::get();
        return view('approvals.approval_stages.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $process_type = DB::table('approval_process_type')->get();

        return view('approvals.approval_stages.create', ['process_type' => $process_type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Approval_stages $approval_stages)
    {
        $approval_stages->approval_stage = $request->approval_stage;
        $approval_stages->process_type_id = $request->process_type_id;
        $approval_stages->save();

        return redirect()->route('approval_stages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Approval_stages $approval_stage)
    {

        $arr['process_type'] = Approval_process_type::pluck('process_type','id');
        return view('approvals.approval_stages.edit', ['approval_stages' => $approval_stage])->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);

        $approval_stages = approval_stages::findOrFail($id);

        $approval_stages->fill($request->all());

        $approval_stages->save();

       // $approval_stages->approval_stage = $request->approval_stage;
        //$approval_stages->process_type_id = $request->process_type_id;
        //$approval_stages->save();

        return redirect()->route('approval_stages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
