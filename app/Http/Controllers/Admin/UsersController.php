<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            $roles = Role::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;

            return $permissions;
        }

        $roles = Role::all();


        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, user $user)
    {

        //validate the fields
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            's_name' => 'required',
            'f_name' => 'required',
            'password' => 'required|between:7,255|confirmed',
            'password_confirmation' =>'required'

        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->s_name = $request->s_name;
        $user->f_name = $request->f_name;
        $user->m_name = $request->m_name;
        $user->member_id = $request->member_id;
        $user->is_member = $request->is_member == null ? 0 : $request->is_member;

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        if($request->permissions != null){
            foreach ($request->permissions as $permission){
                $user->permissions()->attach($permission);
                $user->save();
            }
        }

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {

        return view('admin.users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        $roles = Role::get();
        $userRole = $user->roles->first();
        if($userRole != null){
            $rolePermission = $userRole->allRolePermissions;
        }else{
            $rolePermission = null;
        }

        $userPermissions = $user->permissions;

       //dd($userPermissions);

        return view('admin.users.edit', [
            'user'=>$user,
            'roles'=>$roles,
            'userRole'=>$userRole,
            'rolePermission'=>$rolePermission,
            'userPermissions'=>$userPermissions
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            's_name' => 'required',
            'f_name' => 'required',
            //'password' => 'required|between:8,255',
          //  'password_confirmation' =>'required'

        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->s_name = $request->s_name;
        $user->f_name = $request->f_name;
        $user->m_name = $request->m_name;
        $user->is_member = $request->is_member == null ? 0 : $request->is_member;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->roles()->detach();
        $user->permissions()->detach();

        if($request->role !=null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        if($request->permissions !=null){
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }

        }

        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
