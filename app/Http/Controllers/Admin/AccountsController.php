<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acc_trans_type;
use App\Models\Account_class;
use App\Models\Account_group;
use App\Models\Account_type;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
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
        $arr['accounts'] = Accounts::all();
        return view('admin.accounts.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['account_type'] = Account_type::all();
        $arr['account_class'] = Account_class::all();
        $arr['account_group'] = Account_group::all();
        $arr['acc_trans_type'] = Acc_trans_type::all();
        return view('admin.accounts.create')->with($arr);
    }

    public function getAccGroup(Request $request)
    {
    $account_groups = DB::table("account_groups")
    ->where("account_class_id",$request->account_class_id)
    ->pluck("account_group","id");
    return response()->json($account_groups);
    }

    public function getAccTransType(Request $request)
    {
    $acc_trans_type = DB::table("acc_trans_types")
    ->where("acc_type_id",$request->account_type_id)
    ->pluck("acc_trans_type","id");
    return response()->json($acc_trans_type);
    }

    public function getAccType(Request $request)
    {
    $account_types = DB::table("account_types")
    ->where("account_group_id",$request->account_group_id)
    ->pluck("account_type","id");
    return response()->json($account_types);
    }

    public function getAccounts(Request $request)
    {
    $accounts = DB::table('paymethodaccounts')
                    ->join('accounts', 'paymethodaccounts.account_trans_id', '=', 'accounts.acc_trans_type_id')
                    ->where("pay_id",$request->pay_method_id)
                    ->pluck("account_name","accountcode");
    return response()->json($accounts);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, accounts $accounts)
    {
        $id = Auth::id();

        $accounts->accountcode = $request->accountcode;
        $accounts->account_name = $request->account_name;
        $accounts->account_type_id = $request->account_type_id;
        $accounts->account_class_id = $request->account_class_id;
        $accounts->acc_trans_type_id = $request->acc_trans_type_id;
        $accounts->account_group_id = $request->account_group_id;
        $accounts->account_no = $request->account_no;
        $accounts->status = $request->status;
        $accounts->posted_by = $id;
        $accounts->save();
        return redirect('admin/accounts');
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
    public function edit(Accounts $accounts)
    {
        $arr['accounts'] = $accounts;
        $arr['account_type'] = Account_type::all();
        $arr['account_class'] = Account_class::all();
        $arr['account_group'] = Account_group::all();
        return view('admin.accounts.edit')->with($accounts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accounts $accounts)
    {
        $accounts->accountcode = $request->accountcode;
        $accounts->acount_name = $request->acount_name;
        $accounts->account_type_id = $request->account_type_id;
        $accounts->account_class_id = $request->account_class_id;
        $accounts->acc_trans_type_id = $request->acc_trans_type_id;
        $accounts->account_group_id = $request->account_group_id;
        $accounts->account_no = $request->account_no;
        $accounts->status = $request->status;
        $accounts->posted_by = $request->posted_by;
        $accounts->save();
        return redirect('admin/accounts');
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
