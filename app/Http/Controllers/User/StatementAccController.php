<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\members;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;

class StatementAccController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function StatementAccSearch()
    {
        return view('user.statement_acc.statement_search');
    }
    public function StatementAccSearchAll()
    {
        $arr['member'] = members::get();
        return view('admin.statement_acc.statement_search')->with($arr);
    }

    public function StatementAcc(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $member_id = $request->member_id;


        $arr['members'] = members::where('member_id', $member_id )->first();
        $query = Transactions::where('member_id',  $member_id )->orderBy('transaction_date', 'asc')->whereIn('trans_type_id', [1,2,3]);

         if ($date_from)
            $query->where('transaction_date','>=', $date_from);

        if ($date_to)
            $query->where('transaction_date','<=', $date_to);

            $transaction = $query->get();

        return view('user.statement_acc.statement_acc', ['transaction' => $transaction])->with($arr);
    }
}
