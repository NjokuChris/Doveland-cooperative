<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loans;
use Illuminate\Http\Request;
use App\Models\Loans_type;
use App\Models\Payrollheaders;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Loans_schedule;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Months;

class LoansController extends Controller
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
        $member_id = Auth::user()->member_id;
        $arr['loans'] = loans::where('member_id', $member_id)->orderBy('id', 'desc')->get();

        //dd($member_id);
        return view('user.loans.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firstapproval = collect(DB::select('SELECT dbo.GetFirstApproval(1) AS nb'))->first()->nb;

        $arr['loans_type'] = Loans_type::select(['id','loans_type'])->get();
        $arr['months'] = Months::select(['id','month_name'])->get();
        $arr['approving_officer'] = User::select(['id','name'])
        ->where('id', $firstapproval)->get();
        return view('user.loans.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Loans $loans)
    {
        $request->validate([
            //'member_id' => 'required',
            'amount1' => 'required',
            'tenor' => 'required',
            'interest_rate' => 'required',
            'monthlydeduction' => 'required',
            'loan_type_id' => 'required',
            'paystartperiod_id' => 'required',


        ]);
        $parameter = $request->first_approver;
        $posted_by = Auth::id();
        $member_id = Auth::user()->member_id;
        $approval_stage_id =  collect(DB::select('SELECT dbo.GetApprovalStageID(?) AS nb', [$parameter]))->first()->nb;
        $loans_id = IdGenerator::generate(['table' => 'Loans','field' => 'loans_id', 'length' => 8, 'prefix' => 'LN-' ]);

       // dd($date);


        $interest_amount = $request->amount1 / 100 * $request->interest_rate;
       // dd($request);


        $loans->loans_id = $loans_id;
        $loans->member_id =$member_id;
        $loans->loanamount = $request->amount1;
        $loans->tenor = $request->tenor;
        $loans->interest_rate = $request->interest_rate;
        $loans->interestamount =  $interest_amount;
        $loans->monthlydeduction = $request->monthlydeduction;
        $loans->total_payable_amount = $request->total_amount;
        $loans->loan_type_id = $request->loan_type_id;
        $loans->loans_date = date('Y-m-d');
        $loans->paystartperiod_id = $request->paystartperiod_id;
        $loans->payendperiod_id = $request->paystartperiod_id + $request->tenor - 1;
        $loans->transID = '2';
        $loans->posted_by = $posted_by;
        $loans->approval_stage_id = $approval_stage_id;
        $loans->bank_name = $request->bank_name;
        $loans->acc_no   = $request->acc_no;
        $loans->first_approver = $request->first_approver;
        $loans->save();

        return redirect("admin/loans/{$loans->id}")->with('message', 'Loan Application Booked Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function show($id, Loans $loans)
    {
        $arr['loans_schedule'] = Loans_schedule::select(['payroll_id','period_description','amount2debit'])
        ->where('loans_id', $id)->get();
        return view('admin.loans.show', ['loans' => loans::findOrFail($id)])->with($arr);
    }

    public function track($id)
    {
        //$arr['loans'] = $loans;
        //echo($id);
        $arr['approvals'] = DB::table('approvals')
            ->join('loans', 'approvals.application_id', '=', 'loans.loans_id')
            ->join('approval_stages', 'approval_stages.id', '=', 'loans.approval_stage_id')
            ->join('users', 'users.id', '=', 'approvals.approve_by')
            ->select('approval_date', 'comments', 'approval_stage','name','loans.loans_id','loans.created_at','tenor','loanamount','interest_rate','interestamount','total_payable_amount')
            ->where('loans.id', $id)
            ->get();
          // dd($arr);
        return view('admin.loans.track', ['loans' => loans::findOrFail($id)])->with($arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function edit(Loans $loans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loans $loans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loans  $loans
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loans $loans)
    {
        //
    }
}
