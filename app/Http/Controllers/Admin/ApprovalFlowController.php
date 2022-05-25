<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approval_ProcessFlow;
use App\Models\Approval_ProcessModules;
use App\Models\Approval_stages;
use Illuminate\Http\Request;
use Prophecy\Prophecy\Revealer;

class ApprovalFlowController extends Controller
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
        return view('approvals.approval_flow.index', ['approval_flow' => Approval_ProcessFlow::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['process_module'] = Approval_ProcessModules::all();
        $arr['approval_stage'] = Approval_stages::all();
        return view('approvals.approval_flow.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Approval_ProcessFlow $approval_flow)
    {
        $approval_flow->process_module_id = $request->process_module_id;
        $approval_flow->approval_stage_id = $request->approval_stage_id;
        $approval_flow->process_no = $request->process_no;
        $approval_flow->active_id = $request->active_id;
        $approval_flow->save();

        return redirect()->route('approval_flow.index');
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
    public function edit(Approval_ProcessFlow $approval_flow)
    {
        $arr['approval_flow'] = $approval_flow;
        $arr['process_module'] = Approval_ProcessModules::pluck('process_module', 'id');
        $arr['approval_stages'] = Approval_stages::pluck('approval_stage', 'id');
        return view('approvals.approval_flow.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approval_ProcessFlow $approval_flow)
    {
        $approval_flow->process_module_id = $request->process_module_id;
        $approval_flow->approval_stage_id = $request->approval_stage_id;
        $approval_flow->process_no = $request->process_no;
        $approval_flow->active_id = $request->active_id;
        $approval_flow->save();

        return redirect()->route('approval_flow.index');
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
