<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\branch_location;
use App\Models\members;
use Illuminate\Http\Request;


class branch_locationsController extends Controller
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
        $arr['branch'] = branch_location::all();
        return view('admin.branch.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['members'] = members::all();
        return view('admin.branch.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, branch_location $branch_location)
    {
        $branch_location->branch = $request->branch;
        $branch_location->branch_code = $request->branch_code;
        $branch_location->cordinator_id = $request->cordinator_id;
        $branch_location->save();
        return redirect()->route('branch.index');
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
    public function edit(branch_location $branch)
    {
        $arr['branch'] = $branch;
        return view('admin.branch.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, branch_location $branch)
    {

        $branch->branch = $request->branch;
        $branch->branch_code = $request->branch_code;
        $branch->cordinator_id = $request->cordinator_id;
        $branch->save();
        return redirect('admin/branch');
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
