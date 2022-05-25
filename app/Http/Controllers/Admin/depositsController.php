<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Members;
use App\Models\Transactions;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;


class depositsController extends Controller
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
        $arr['deposits'] = Deposits::all();
        return view('admin.deposits.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.deposits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Deposits $deposits,Transactions $transactions)
    {
        $validatedData = $request->validate([
            'member_id'=>'required|numeric|exists:members,member_id',
            'amount'=>'required|numeric',
            'deposit_date' => 'required|date'
        ]);
        if($validatedData['amount'] <= 0){
            return back()->with('message2', 'Transaction Declined!, Invalid Deposit Amount');
        }

        $member = Members::where('member_id', $request->member_id)->where('member_status', 1)->firstOrFail();

        $member_id = $request->member_id;
        $amount = $request->amount;
        $running_balance = $member->current_balance;
        $balance = $running_balance + $validatedData['amount'];

       // dd($request);

       // DB::enableQueryLog();

        DB::beginTransaction();

        try{
            DB::update('update members set current_balance = current_balance + ? where member_id = ?', [$amount,$member_id]);

            $posted_by = Auth::id();
            $deposit_id = IdGenerator::generate(['table' => 'deposits','field' => 'deposit_id', 'length' => 8, 'prefix' => 'DT-' ]);

            $deposits->deposit_id = $deposit_id;
            $deposits->member_id = $request->member_id;
            $deposits->amount = $request->amount;
            $deposits->deposit_date = $request->deposit_date == null ? null : date(' Y-m-d', strtotime($request->deposit_date));
            $deposits->transID = '2';
            $deposits->naration = $request->naration;
            $deposits->posted_by = $posted_by;
            $deposits->save();

            $transactions->member_id = $validatedData['member_id'];
            $transactions->amount = $validatedData['amount'];
            $transactions->transaction_date = $validatedData['deposit_date'] == null ? null : date(' Y-m-d', strtotime($validatedData['deposit_date']));
            $transactions->trans_type_id = '3';
            $transactions->naration = $request->naration;
            $transactions->credit = $validatedData['amount'];
            $transactions->balance = $balance;
            $transactions->save();

            DB::commit();
            //$erro = DB::getQueryLog();
            //print_r($erro);
           return back()->with('message', 'Cash Deposit saved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message2', 'Cash Deposit failled');
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
    public function edit(Deposits $deposits)
    {
        $arr['deposit'] = $deposits;
        return view('admin.deposits.edit')->with($arr);
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
