<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Pay_method;
use App\Models\payments;
use App\Models\receipts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class receiptsController extends Controller
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

        $arr['receipts'] = receipts::all();
        return view('admin.receipts.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['pay_method'] = Pay_method::all();
        return view('admin.receipts.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, receipts $receipts)
    {
        $id = Auth::id();

        $receipts_id = IdGenerator::generate(['table' => 'receipts','field' => 'receipts_id', 'length' => 8, 'prefix' => 'RC-' ]);
        //output: INV-000001

        $receipts->receipts_id = $receipts_id;
        $receipts->subaccountcode = $request->customer_id;
        $receipts->amount_paid = $request->amount_paid;
        $receipts->account_no = $request->account_no;
        $receipts->method_pay = $request->method_pay;
        $receipts->paid_by = $request->paid_by;
        $receipts->naration = $request->naration;
        $receipts->posted_by = $id;
        $receipts->receipt_date = date("Y-m-d");
        $receipts->save();

        //$m = 'The record for ' . strtoupper($receipts->paid_by). '  has been Successfully Saved to the Database.' ;
        // Session::flash('statuscode','info');
        return redirect("admin/receipt/{$receipts->id}")->with('message', 'The transaction has been receipted Successfully!');
        // return back()->with('message', $m);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arr['receip'] = DB::table('receipts')
             ->select(DB::raw('id,amount_paid,paid_by,naration,created_at,dbo.NumberToWords(amount_paid) as word'))
             ->where('id', '=', $id)
             ->first();

                //return view('admin.receipts.show')->with($arr);
        return view('admin.receipts.show', ['receipts' => receipts::findOrFail($id)])->with($arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr['accounts'] = Accounts::all();
        $arr['pay_method'] = Pay_method::all();
        return view('admin.receipts.edit', ['receipts' => receipts::findOrFail($id)])->with($arr);
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
        $loans = receipts::where('id', '=', $id)->first();

        $loans->update($request->all());

        return redirect("admin/receipt")->with('message', 'Receipts Adjustment was Successfully!');
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
