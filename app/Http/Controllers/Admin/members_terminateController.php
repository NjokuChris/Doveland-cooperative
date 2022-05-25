<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\members_terminate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class members_terminateController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, members_terminate $members_terminate)
    {
        DB::beginTransaction();

        try {

        $members_terminate->member_id = $request->member_id;
        $members_terminate->reason = $request->reason;

        $members_terminate->save();

        DB::update('update members set member_status = ? where member_id = ?', ['2', $request->member_id]);

        DB::commit();

        $m = 'The record for ' . strtoupper($request->member_name). ' has been Successfully Terminated and moved to Alumni.';
       // Session::flash('statuscode','info');
        return redirect(route('members.index'))->with('message', $m);

             } catch (\Exception $e) {
                 DB::rollBack();
                 return back()->with('message2', 'Member Termination failled');
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
        return view('admin.member_terminate.create', ['member' => Members::findOrFail($id)]);
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
