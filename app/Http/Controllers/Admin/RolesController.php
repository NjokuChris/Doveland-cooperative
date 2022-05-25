<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approval_stages;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
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
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['approval_stage'] = Approval_stages::select(['id','approval_stage'])->get();
        $arr['permissions'] = Permission::all()->pluck('name', 'id');
        return view('admin.roles.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {

        //validate the role fields
        $request->validate([
            'name' => 'required|unique:roles,name'

        ]);

        //dd($request);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show',['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $arr['approval_stage'] = Approval_stages::select(['id','approval_stage'])->get();
        $arr['permissions'] = Permission::all()->pluck('name', 'id');
        return view('admin.roles.edit', ['role' => $role])->with($arr);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //$request->validate([
          //  'name' => 'required'

        //]);

        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //$role->permissions()->delete();
        $role->delete();
        $role->permissions()->detach();

        return redirect('/admin/roles');
    }
}
