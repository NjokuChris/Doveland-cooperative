<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\branch_location;
use App\Models\members;
use App\Models\Loans;
use App\Models\Accounts;
use App\Models\company;
use App\Models\Deposits;
use App\Models\Loans_type;
use App\Models\receipts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Accounts_year;
use App\Models\Approval_stages;
use App\Models\Transactions;
use App\Models\withdrawer;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function MembersReport(Request $request)
    {
      // dd($request);
        $member_name = $request->member_name;
        $member_no = $request->member_no;
        $savings_amount = $request->savings_amount;
        $location = $request->locationID;
        $gender = $request->gender;
        $bank = $request->BankID;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $company_id = $request->company_id;

        $query = members::where('member_status','1');

        if ($member_name)
            $query->where('member_name', $member_name);

        if ($member_no)
            $query->where('member_id', $member_no);

        if ($savings_amount)
            $query->where('savings_amount','>=', $savings_amount);

        if ($location)
            $query->where('locationID', $location);

        if ($gender)
            $query->where('gender', $gender);

        if ($bank)
            $query->where('BankID', $bank);

        if ($date_from)
            $query->where('joined_date','>=', $date_from);

        if ($date_to)
            $query->where('joined_date','<=', $date_to);

        if ($company_id)
            $query->where('company_id', $company_id);


        $members = $query->get();

       // $members = members_views::get();
        return view('reports.members.member_reports', ['members' => $members]);
    }

    public function MembersSearch()
    {
        $arr['branch'] = branch_location::all();
        $arr['bank'] = Accounts::where('acc_trans_type_id', 3)->get();
        $arr['company'] = company::where('status', 'Active')->get();
        return view('reports.members.members_search')->with($arr);
    }

    public function LoansSearch()
    {
        $arr['branch'] = branch_location::all();
        $arr['bank'] = Accounts::where('pay_method_id', 2)->get();
        $arr['loans_type'] = Loans_type::select(['salary_group_id','salary_group'])->get();
        $arr['approval_stage'] = Approval_stages::all();
        return view('reports.loans.loans_search')->with($arr);
    }

    public function LoansReport(Request $request)
    {

        $member_no = $request->member_no;
        $loans_id = $request->loans_id;
        $approval_stage_id = $request->approval_stage_id;
        $loanamount = $request->loanamount;
        $loans_type_id = $request->loans_type_id;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $query = Loans::orderBy('id', 'desc');



        if ($member_no)
            $query->where('member_id', $member_no);

        if ($loans_id)
            $query->where('loans_id', $loans_id);

        if ($approval_stage_id)
            $query->where('approval_stage_id', $approval_stage_id);

        if ($loanamount)
            $query->where('savings_amount', $loanamount);

        if ($loans_type_id)
            $query->where('loan_type_id', $loans_type_id);

        if ($date_from)
            $query->where('loans_date','>=', $date_from);

        if ($date_to)
            $query->where('loans_date','<=', $date_to);


        $loans = $query->get();

       // $members = members_views::get();
        return view('reports.loans.loans_report', ['loans' => $loans]);
    }

    public function LoansScheduleSearch()
    {
        $arr['branch'] = branch_location::all();
        $arr['bank'] = Accounts::where('pay_method_id', 2)->get();
        $arr['loans_type'] = Loans_type::select(['salary_group_id','salary_group'])->get();
        return view('reports.loans_schedule.loans_sch_search')->with($arr);
    }

    public function LoansScheduleReport(Request $request)
    {

        $member_no = $request->member_no;
        $loans_id = $request->loans_id;
        $approval_stage_id = $request->approval_stage_id;
        $loanamount = $request->loanamount;
        $loans_type_id = $request->loans_type_id;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $query = Loans::orderBy('id', 'desc');


        if ($member_no)
            $query->where('member_id', $member_no);

        if ($loans_id)
            $query->where('loans_id', $loans_id);

        if ($loanamount)
            $query->where('savings_amount', $loanamount);

        if ($loans_type_id)
            $query->where('loan_type_id', $loans_type_id);

        if ($date_from)
            $query->where('loans_date','>=', $date_from);

        if ($date_to)
            $query->where('loans_date','<=', $date_to);


        $loans = $query->get();

       // $members = members_views::get();
        return view('reports.loans_schedule.loans_sch_report', ['loans' => $loans]);
    }

    public function DepositSearch()
    {

        return view('reports.deposit.deposit_search');
    }

    public function DepositReport(Request $request)
    {

        $member_no = $request->member_no;
        $deposit_amount = $request->amount;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $query = Deposits::orderBy('id', 'desc');


        if ($member_no)
           $query->where('member_id', $member_no);

        if ($deposit_amount)
            $query->where('amount', $deposit_amount);

        if ($date_from)
            $query->where('deposit_date','>=', $date_from);

        if ($date_to)
            $query->where('deposit_date','<=', $date_to);


        $deposits = $query->get();

       // $members = members_views::get();
        return view('reports.deposit.deposit_report', ['deposits' => $deposits]);
    }

    public function withdrawerSearch()
    {
        $arr['approval_stage'] = Approval_stages::all();
        return view('reports.withdrawers.withdrawer_search')->with($arr);
    }

    public function withdrawerReport(Request $request)
    {
        $member_no = $request->member_no;
        $withdrawer_amount = $request->amount;
        $approval_stage_id = $request->approval_stage_id;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $query = withdrawer::orderBy('id', 'desc');


        if ($member_no)
           $query->where('member_id', $member_no);

        if ($withdrawer_amount)
            $query->where('amount', $withdrawer_amount);

        if ($approval_stage_id)
            $query->where('approval_stage_id', $approval_stage_id);

        if ($date_from)
            $query->where('withdrawer_date','>=', $date_from);

        if ($date_to)
            $query->where('withdrawer_date','<=', $date_to);


        $withdrawers = $query->get();

       // $members = members_views::get();
        return view('reports.withdrawers.withdrawer_report', ['withdrawers' => $withdrawers]);
    }

    public function MarginSearch()
    {

        return view('reports.margin.margin_search');
    }

    public function MarginReport(Request $request)
    {

        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $query = Loans::where('interest_rate', '>', 0)->orderBy('id', 'desc');



        if ($date_from)
            $query->where('loans_date', $date_from);

        if ($date_to)
            $query->where('loans_date', $date_to);


        $loans = $query->get();

        return view('reports.margin.margin_report', ['loans' => $loans]);
    }

    public function ReceiptsSearch()
    {
        return view('reports.receipts.receipts_search');
    }

    public function ReceiptsReport(Request $request)
    {
        $receipts_id = $request->receipts_id;
        $amount_paid = $request->amount_paid;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $query = receipts::orderBy('id', 'desc');

        if ($receipts_id)
            $query->where('receipts_id', $receipts_id);

        if ($amount_paid)
            $query->where('amount_paid', $amount_paid);

        if ($date_from)
            $query->where('receipt_date', '>=', $date_from);

        if ($date_to)
            $query->where('receipt_date', '<=', $date_to);


        $receipts = $query->get();

       // $members = members_views::get();
        return view('reports.receipts.receipts_report', ['receipts' => $receipts]);
    }

    public function getPayrollMonth1(Request $request)
    {
        $payrollMonth = DB::table("payrollheaders")
        ->where("year_id",$request->year_id)
        ->where("publish_id",'2')
        ->pluck("period_description","payroll_id");
        return response()->json($payrollMonth);
    }

    public function DeductionSearch()
    {
        $arr['year'] = Accounts_year::all();
        $arr['salary_group'] = Loans_type::select(['salary_group_id','salary_group'])->get();
        return view('reports.deductions.deductions_search')->with($arr);
    }

    public function DeductionsReport(Request $request)
    {
        $payroll_id = $request->payroll_id;
        $receipts_id = $request->receipts_id;


        $query = Transactions::where('payroll_id', $payroll_id)->orderBy('id', 'asc');

        if ($receipts_id)
            $query->where('receipts_id', $receipts_id);

        $receipts = $query->get();


        return view('reports.deductions.deductions_report', ['receipts' => $receipts]);
    }
}
