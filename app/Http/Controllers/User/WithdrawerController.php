<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\withdrawer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Members;
use Illuminate\Support\Facades\DB;

class WithdrawerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member_id = Auth::user()->member_id;
        return view('user.withdrawers.index',['withdrawers' => withdrawer::where('member_id', $member_id)->orderBy('id', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firstapproval = collect(DB::select('SELECT dbo.GetFirstApproval(2) AS nb'))->first()->nb;

        $member_id = Auth::user()->member_id;
        $arr['members'] = Members::where('member_id', $member_id)->first();
        $arr['users'] = User::select(['id','name'])
        ->where('id', $firstapproval)->get();
        return view('user.withdrawers.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, withdrawer $withdrawer)
    {
        $valideatedData = $request->validate([
          //  'member_id' => 'required|numeric|exists:members,member_id',
            'amount' => 'required|numeric',
            'withdrawer_date' => 'required|date'
        ]);
        $member_id = Auth::user()->member_id;
        $member = Members::where('member_id', $member_id)->where('member_status', 1)->firstOrFail();
        if ($valideatedData['amount'] >= $member->current_balance || $valideatedData['amount'] <= 0) {
            return back()->with('message2', 'Transaction Declined!, Withdrawal amount can not be higher than Current Balance');
        }

        $amount = $request->amount;
        $running_balance = $member->current_balance;
        $balance = $running_balance - $valideatedData['amount'];

        // dd($request);

        // DB::enableQueryLog();
            $parameter = $request->first_approver_id;
            $approval_stage_id =  collect(DB::select('SELECT dbo.GetApprovalStageID(?) AS nb', [$parameter]))->first()->nb;
            $withdrawer_id = IdGenerator::generate(['table' => 'withdrawers','field' => 'withdrawer_id', 'length' => 8, 'prefix' => 'WD-' ]);
            $posted_by = Auth::id();

            $withdrawer->withdrawer_id = $withdrawer_id;
            $withdrawer->member_id = $member_id;
            $withdrawer->amount = $valideatedData['amount'];
            $withdrawer->withdrawer_date = $valideatedData['withdrawer_date'] == null ? null : date(' Y-m-d', strtotime($valideatedData['withdrawer_date']));
            $withdrawer->transID = '2';
            $withdrawer->naration = $request->naration;
            $withdrawer->posted_by = $posted_by;
            $withdrawer->bank_name = $request->bank_name;
            $withdrawer->acc_no = $request->acc_no;
            $withdrawer->first_approver_id = $request->first_approver_id;
            $withdrawer->approval_stage_id = $approval_stage_id;
            $withdrawer->save();

            return back()->with('message', 'Cash Withdrawer saved successfully and forwarded for Approval');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\withdrawer  $withdrawer
     * @return \Illuminate\Http\Response
     */
    public function show(withdrawer $withdrawer)
    {
        //
    }

    public function track($id)
    {
        //$arr['loans'] = $loans;
        //echo($id);
        $arr['approvals'] = DB::table('approvals')
            ->join('withdrawers', 'approvals.application_id', '=', 'withdrawers.withdrawer_id')
            ->join('approval_stages', 'approval_stages.id', '=', 'withdrawers.approval_stage_id')
            ->join('users', 'users.id', '=', 'approvals.approve_by')
            ->select('approval_date', 'comments', 'approval_stage','name')
            ->where('withdrawers.id', $id)
            ->get();
          // dd($arr);
        return view('user.withdrawers.track', ['withdrawers' => withdrawer::findOrFail($id)])->with($arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\withdrawer  $withdrawer
     * @return \Illuminate\Http\Response
     */
    public function edit(withdrawer $withdrawer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\withdrawer  $withdrawer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, withdrawer $withdrawer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\withdrawer  $withdrawer
     * @return \Illuminate\Http\Response
     */
    public function destroy(withdrawer $withdrawer)
    {
        //
    }
}
