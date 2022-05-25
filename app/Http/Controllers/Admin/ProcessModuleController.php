<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approval_ProcessModules;
use Illuminate\Http\Request;

class ProcessModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['process_module'] = Approval_ProcessModules::all();
        return view('approvals.process_modules.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('approvals.process_modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Approval_ProcessModules $process_module)
    {
        $process_module->process_module = $request->process_module;
        $process_module->save();

        return redirect()->route('process_module.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Approval_ProcessModules  $approval_ProcessModules
     * @return \Illuminate\Http\Response
     */
    public function show(Approval_ProcessModules $approval_ProcessModules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Approval_ProcessModules  $approval_ProcessModules
     * @return \Illuminate\Http\Response
     */
    public function edit(Approval_ProcessModules $approval_ProcessModules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Approval_ProcessModules  $approval_ProcessModules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approval_ProcessModules $approval_ProcessModules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Approval_ProcessModules  $approval_ProcessModules
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approval_ProcessModules $approval_ProcessModules)
    {
        //
    }
}
