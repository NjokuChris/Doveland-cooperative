<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\withdrawer;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;

class withdrawersContoller extends Controller
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
        $arr['withdrawers'] = withdrawer::all();
        return view('admin.withdrawers.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.withdrawers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, withdrawer $withdrawer, Transactions $transactions)
    {
        $valideatedData = $request->validate([
            'member_id' => 'required|numeric|exists:members,member_id',
            'amount' => 'required|numeric',
            'withdrawer_date' => 'required|date'
        ]);
        $member = Members::where('member_id', $request->member_id)->where('member_status', 1)->firstOrFail();
        if ($valideatedData['amount'] > $member->current_balance || $valideatedData['amount'] <= 0) {
            return back()->with('message2', 'Transaction Declined!, Withdrawal amount can not be higher than Current Balance');
        }

        $member_id = $request->member_id;
        $amount = $request->amount;
        $running_balance = $member->current_balance;
        $balance = $running_balance - $valideatedData['amount'];

        // dd($request);

        // DB::enableQueryLog();

        DB::beginTransaction();

        try {
            DB::update('update members set current_balance = current_balance - ? where member_id = ?', [$amount, $member_id]);

            $withdrawer_id = IdGenerator::generate(['table' => 'withdrawers','field' => 'withdrawer_id', 'length' => 8, 'prefix' => 'WD-' ]);
            $posted_by = Auth::id();

            $withdrawer->withdrawer_id = $withdrawer_id;
            $withdrawer->member_id = $valideatedData['member_id'];
            $withdrawer->amount = $valideatedData['amount'];
            $withdrawer->withdrawer_date = $valideatedData['withdrawer_date'] == null ? null : date(' Y-m-d', strtotime($valideatedData['withdrawer_date']));
            $withdrawer->transID = '2';
            $withdrawer->approval_stage_id = '4';
            $withdrawer->naration = $request->naration;
            $withdrawer->bank_name = $request->bank_name;
            $withdrawer->acc_no = $request->acc_no;
            $withdrawer->posted_by = $posted_by;
            $withdrawer->save();

             $transactions->member_id = $valideatedData['member_id'];
             $transactions->amount = $valideatedData['amount'];
             $transactions->transaction_date = $valideatedData['withdrawer_date'] == null ? null : date(' Y-m-d', strtotime($valideatedData['withdrawer_date']));
             $transactions->trans_type_id = '3';
             $transactions->naration = $request->naration;
             $transactions->debit = $valideatedData['amount'];
             $transactions->balance = $balance;
             $transactions->save();

            DB::commit();
            //$erro = DB::getQueryLog();
            //print_r($erro);
            return back()->with('message', 'Cash Withdrawer saved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message2', 'Cash Withdrawer failled');
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
        return view('admin.withdrawers.edit', ['withdrawer' => withdrawer::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, withdrawer $withdrawer)
    {
        $valideatedData = $request->validate([
            'member_id' => 'required|numeric|exists:members,member_id',
            'amount' => 'required|numeric',
            'withdrawer_date' => 'required|date'
        ]);
        $member = Members::where('member_id', $request->member_id)->where('member_status', 1)->firstOrFail();
        $withdrawer->member_id = $valideatedData['member_id'];
        if ($valideatedData['amount'] > $member->current_balance || $valideatedData['amount'] <= 0) {
            return back()->with('message2', 'Transaction Declined!, Withdrawal amount can not be higher than Current Balance');
        }
        $withdrawer->amount = $valideatedData['amount'];
        $withdrawer->withdrawer_date = $valideatedData['withdrawer_date'] == null ? null : date(' Y-m-d', strtotime($valideatedData['withdrawer_date']));
        $withdrawer->transID = '2';
        $withdrawer->naration = $request->naration;
        $withdrawer->bank_name = $request->bank_name;
        $withdrawer->acc_no = $request->acc_no;
        $withdrawer->save();

       // return back()->with('message', 'Cash Withdrawer saved successfully');
        return redirect('/admin/withdrawerapproval')->with('message', 'Cash Withdrawer saved successfully');
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
