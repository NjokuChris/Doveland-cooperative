<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\branch_location;
use App\Models\company;
use Illuminate\Http\Request;
use App\Models\members;
use App\Models\Subaccountcode;
use App\Models\Title;
use App\Models\Transactions;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
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


       $members = Members::where('member_status', '1')->orderBy('member_id', 'desc')->get();
        return view('members', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['company'] = company::where('status', 'Active')->get();
        $arr['title'] = Title::all();
        $arr['bank'] = Accounts::where('pay_method_id', 2)->get();
        $arr['branch'] = branch_location::all();
        return view('admin.members.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, members $member, Transactions $transactions, Subaccountcode $subaccountcode)
    {

        $request->validate([
            'firstName' => 'required',
            'surName' => 'required',
            'joined_date' => 'required',

        ]);

        if(isset($request->photo) && $request->photo->getClientOriginalName()){
            $ext = $request->photo->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->photo->storeAs('public/photo',$file);
        }
        else
        {
            $file = '';
        }

        DB::beginTransaction();

        try {

       $member->member_no = $request->member_no;
       $member->firstName = $request->firstName;
       $member->middleName = $request->middleName;
       $member->surName = $request->surName;
       $member->member_name = trim(strtoupper($member->surName).' '. strtoupper($member->firstName) . ' ' . strtoupper($member->middleName)) ;
       $member->savings_amount = $request->savings_amount;
       $member->posted_date = $request->posted_date;
       $member->LocationID = $request->LocationID;
       $member->joined_date = $request->joined_date == null ? null : date(' Y-m-d', strtotime($request->joined_date));
       $member->H_address = $request->H_address;
       $member->email = $request->email;
       $member->phoneNo = $request->phoneNo;
       $member->is_staff = $request->ismember_charges;
       $member->employee_no = $request->employee_no;
       $member->company_id = $request->company_id;
       $member->date_birth = $request->date_birth == null ? null : date(' Y-m-d', strtotime($request->date_birth));
       $member->gender = $request->gender;
       $member->Home_location = $request->Home_location;
       $member->H_state = $request->H_state;
       $member->BankID = $request->BankID;
       $member->BankAcc_no = $request->BankAcc_no;
       $member->photo = $file;
       $member->posted_by = $request->posted_by;
       $member->title = $request->title;
       $member->membership_charges = $request->membership_charges;
       $member->referee = $request->referee;

       $member->save();

       $subaccountcode->subaccount_name = trim(strtoupper($member->surName).' '. strtoupper($member->firstName) . ' ' . strtoupper($member->middleName)) ;
       $subaccountcode->subaccountcode = $member->member_id;
       $subaccountcode->subaccount_type = 1;
       $subaccountcode->status = 1;

       $subaccountcode->save();

       DB::commit();

       $m = 'The record for ' . strtoupper($member->surName).' '. strtoupper($member->firstName) . ' ' . strtoupper($member->middleName) . ' has been Successfully Saved to the Database.' ;
      // Session::flash('statuscode','info');
       return back()->with('message', $m);

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('message2', 'Member Registration failled');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $member_id
     * @return \Illuminate\Http\Response
     */
    public function show(members $member)
    {
        return view('admin.members.show',['member' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $member_id
     * @return \Illuminate\Http\Response
     */
    public function edit(members $member)
    {
       $arr['title'] = Title::all();
       $arr['member'] = $member;
       $arr['bank'] = Accounts::where('pay_method_id', 2)->pluck('account_name','id');
       $arr['company'] = company::where('status', 'Active')->pluck('company_name','company_id');
       $arr['branch'] = branch_location::pluck('branch','id');

       return view('admin.members.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, members $member)
    {

        $request->validate([
            'firstName' => 'required',
            'surName' => 'required',
            'savings_amount' => 'required',
            'joined_date' => 'required',

        ]);

        if(isset($request->photo) && $request->photo->getClientOriginalName()
        ){
            $ext = $request->photo->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->photo->storeAs('public/photo',$file);
        }
        else
        {
            if(!$member->photo)
                $file = '';
            else
                $file = $member->photo;
        }
        $member->member_no = $request->member_no;
        $member->firstName = $request->firstName;
        $member->middleName = $request->middleName;
        $member->surName = $request->surName;
        $member->member_name = strtoupper($member->surName).' '. strtoupper($member->firstName) . ' ' . strtoupper($member->middleName);
        $member->savings_amount = $request->savings_amount;
        $member->posted_date = $request->posted_date;
        $member->LocationID = $request->LocationID;
        $member->joined_date = $request->joined_date == null ? null : date(' Y-m-d', strtotime($request->joined_date));
        $member->H_address = $request->H_address;
        $member->email = $request->email;
        $member->phoneNo = $request->phoneNo;
        $member->is_staff = $request->ismember_charges;
        $member->employee_no = $request->employee_no;
        $member->company_id = $request->company_id;
        $member->date_birth = $request->date_birth == null ? null : date(' Y-m-d', strtotime($request->date_birth));
        $member->gender = $request->gender;
        $member->Home_location = $request->Home_location;
        $member->H_state = $request->H_state;
        $member->BankID = $request->BankID;
        $member->BankAcc_no = $request->BankAcc_no;
        $member->photo = $file;
        $member->posted_by = $request->posted_by;
        $member->title = $request->title;
        $member->membership_charges = $request->membership_charges;
        $member->referee = $request->referee;
        $member->save();

        return redirect()->route('members.show',$member->member_id)->with('message', 'Member details adjusted successfully');
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
