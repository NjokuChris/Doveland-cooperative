<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approval_stages;
use App\Models\approval_types;
use App\Models\approvalmaster;
use Illuminate\Http\Request;

class ApprovalMasterController extends Controller
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
        return view('approvals.approval_master.index', ['approval_master' => approvalmaster::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['approval_type'] = approval_types::all();
        $arr['approval_stage'] = Approval_stages::all();
        return view('approvals.approval_master.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, approvalmaster $approvalmaster)
    {

        $approvalmaster->approval_type_id = $request->approval_type_id;
        $approvalmaster->approval_stage_id = $request->approval_stage_id;
        $approvalmaster->approve_desc = $request->approve_desc;
        $approvalmaster->save();

        return redirect()->route('approval_master.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\approvalmaster  $approvalmaster
     * @return \Illuminate\Http\Response
     */
    public function show(approvalmaster $approvalmaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\approvalmaster  $approvalmaster
     * @return \Illuminate\Http\Response
     */
    public function edit(approvalmaster $approvalmaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\approvalmaster  $approvalmaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, approvalmaster $approvalmaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\approvalmaster  $approvalmaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(approvalmaster $approvalmaster)
    {
        //
    }
}
