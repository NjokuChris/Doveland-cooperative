<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loans;
use App\Models\Loans_schedule;
use App\Models\Members;
use App\Models\Loans_type;
use App\Models\Months;
use App\Models\Payrollheaders;
use App\Models\period;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;




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

        $arr['loans'] = loans::orderBy('id', 'desc')->get();

        //dd($arr);
        return view('admin.loans.index')->with($arr);

        //return view('admin.loans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['loans_type'] = Loans_type::select(['id','loans_type'])->get();
        $arr['months'] = Months::select(['id','month_name'])->get();
        return view('admin.loans.create')->with($arr);
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
            'member_id' => 'required',
            'amount1' => 'required',
            'tenor' => 'required',
            'interest_rate' => 'required',
            'monthlydeduction' => 'required',
            'loan_type_id' => 'required',
            'paystartperiod_id' => 'required',


        ]);

        $posted_by = Auth::id();
        $loans_id = IdGenerator::generate(['table' => 'Loans','field' => 'loans_id', 'length' => 8, 'prefix' => 'LN-' ]);


        $interest_amount = $request->amount1 / 100 * $request->interest_rate;
       // dd($request);

       DB::beginTransaction();

       try{
        $loans->loans_id = $loans_id;
        $loans->member_id = $request->member_id;
        $loans->loanamount = $request->amount1;
        $loans->tenor = $request->tenor;
        $loans->interest_rate = $request->interest_rate;
        $loans->interestamount =  $interest_amount;
        $loans->monthlydeduction = $request->monthlydeduction;
        $loans->total_payable_amount = $request->total_amount;
        $loans->loan_type_id = $request->loan_type_id;
        $loans->loans_date = $request->loans_date;
        $loans->paystartperiod_id = $request->paystartperiod_id;
        $loans->payendperiod_id = $request->paystartperiod_id + $request->tenor - 1;
        $loans->transID = '2';
        $loans->approval_stage_id = '4';
        $loans->bank_name = $request->bank_name;
        $loans->acc_no = $request->acc_no;
        $loans->posted_by = $posted_by;
        $loans->save();

       DB::statement("execute Proc_loans_schedule $loans->id ");
       DB::commit();
        return redirect("admin/loans/{$loans->id}")->with('message', 'Loan Application Booked Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message2', 'Loan Transaction failled');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$arr['loans'] = $loans;
        //echo($id);
        $arr['loans_schedule'] = Loans_schedule::select(['payroll_id','period_description','amount2debit'])
        ->where('loans_id', $id)->get();
        return view('admin.loans.show', ['loans' => loans::findOrFail($id)])->with($arr);
    }

    public function track($id)
    {
        //$arr['loans'] = $loans;
        //echo($id);
        $arr['loans'] = DB::table('approvals')
            ->join('loans', 'approvals.application_id', '=', 'loans.loans_id')
            ->join('approval_stages', 'approval_stages.id', '=', 'loans.approval_stage_id')
            ->join('members', 'members.member_id', '=', 'loans.member_id')
            ->select('approval_date', 'comments', 'approval_stage','member_name')
            ->where('loans.loans_id', $id)
            ->first();
            //dd($arr);
        return view('admin.loans.track')->with($arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr['loans_type'] = Loans_type::select(['salary_group_id','salary_group'])->where('salary_class_id', '17')->get();
        $arr['payrollheaders'] = Payrollheaders::select(['payroll_id','period_description'])
        ->where('publish_id', '1')->get();
        return view('admin.loans.edit', ['loans' => loans::findOrFail($id)])->with($arr);
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
        $loans = Loans::where('id', '=', $id)->first();

        $loans->update($request->all());

        return redirect("admin/loanapprovalbin")->with('message', 'Loan Application Booked Successfully!');
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

    public function getMember()
    {
        $m=Members::where('member_status', 1)->get();

        return response()->json($m);
    }
    }
