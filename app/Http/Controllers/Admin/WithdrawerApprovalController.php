<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approvals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\withdrawer;
use Illuminate\Support\Facades\DB;

class WithdrawerApprovalController extends Controller
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
        $user_id = Auth::id();
        $approval_stage_id =  collect(DB::select('SELECT dbo.GetApprovalStageID(?) AS nb', [$user_id]))->first()->nb;
        $arr['withdrawer'] = withdrawer::where('approval_stage_id', $approval_stage_id)->orderBy('id', 'desc')->get();
       // $arr['withdrawer1'] = withdrawer::where('approval_stage_id', $approval_stage_id)->orderBy('id', 'desc')->get();
        return view('approvals.withdrawer_approval.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Approvals $approvals)
    {
        $approvals->application_id = $request->withdrawer_id;
        $approvals->approval_date = $request->approval_date;
        $approvals->approve_by = $request->approve_by;
        $approvals->comments = $request->comments;
        $approvals->approve_id = $request->approve_id;
        $approvals->trans_type_id = 3;
        $approvals->save();

        DB::statement("execute proc_withdrawerApprove $approvals->id ");
        return redirect()->route('withdrawerapproval.index')->with('message', 'Withdrawer Approval was Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('approvals.loan_approval_bin.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        //$arr['approvals'] = Approvals::where('id', $id);
        $approval_stage_id =  collect(DB::select('SELECT dbo.GetApprovalStageID(?) AS nb', [$user_id]))->first()->nb;
        $arr['approval_type'] = DB::table('approval_types')
            ->join('approvalmasters', 'approvalmasters.approval_type_id', '=', 'approval_types.id')
            ->where('approvalmasters.approval_stage_id', '=', $approval_stage_id)
            ->select('approvalmasters.id', 'approval_types.approve_type')
            ->get();

        return view('approvals.withdrawer_approval.create',['withdrawer' => withdrawer::findOrFail($id)])->with($arr);
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
        //
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
