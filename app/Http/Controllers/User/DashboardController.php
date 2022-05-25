<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Loans;
use App\Models\Members;
use App\Models\cart;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }

    public function index()
    {

    $arr['member'] = members::where('member_id',  Auth::user()->member_id )->first();
       $arr['loans'] = Loans::where(
             'member_id', '=',  Auth::user()->member_id)
             ->where('balance', '>', '1')->get();
        $arr['transaction'] = Transactions::where('member_id',  Auth::user()->member_id )->orderBy('transaction_date', 'desc')->take(5)->get();

       return view('user.dashboard')->with($arr);
    }

}
