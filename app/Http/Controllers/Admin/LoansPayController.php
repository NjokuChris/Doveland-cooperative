<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loans_type;
use App\Models\period;
use App\Models\Loans;
use App\Models\Loans_pay;
use App\Models\Payrollheaders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class LoansPayController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Loans_pay $loans_pay)
    {
        if ($request->paymenttype == 2) {
            $valideatedData = $request->validate([
                'loans_id' => 'required|exists:loans,loans_id',
                'amount_pay' => 'required|numeric',
                'loan_balance' => 'required|numeric',
                'new_balance' => 'required|numeric',
                'tenor' => 'required|numeric',
                'paystartmonth_id' => 'required|numeric',

            ]);

            $loans_pay->loans_id = $request->l_id;
            $loans_pay->amount_pay = $request->amount_pay;
            $loans_pay->date_pay = $request->date_pay;
            $loans_pay->pay_type_id = $request->paymenttype;
            $loans_pay->new_balance = $request->new_balance;
            $loans_pay->loan_balance = $request->loan_balance;
            $loans_pay->tenor = $request->tenor;
            $loans_pay->paystartmonth_id = $request->paystartmonth_id;
            $loans_pay->payendmonth_id = $request->paystartmonth_id + $request->tenor - 1;

            $loans_pay->save();
            DB::statement("execute Proc_loans_reschedule $loans_pay->id ");

            return redirect('/admin/loans')->with('message', 'Loans Cash payments saved successfully');
        }
        else {
            $loans_pay->loans_id = $request->l_id;
            $loans_pay->amount_pay = $request->amount_pay;
            $loans_pay->date_pay = $request->date_pay;
            $loans_pay->pay_type_id = $request->paymenttype;

            $loans_pay->save();

            DB::statement("execute Proc_loans_reschedule $loans_pay->id ");

            return redirect('/admin/loans')->with('message', 'Loans Cash payments saved successfully');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr['loans_type'] = Loans_type::all();
        $arr['payrollheaders'] = Payrollheaders::select(['payroll_id','period_description'])->where('payroll_id', '>', '208')
        ->where('publish_id', '1')->get();
        return view('admin.loans_pay.create',['loans' => loans::findOrFail($id)])->with($arr);
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
