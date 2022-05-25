<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Datatables;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('users');
    }
    public function usersList()
    {
        $users = DB::table('users')->select('*');
        return datatables()->of($users)
        ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'. route('members.edit',$row->id)  .'" class="edit btn btn-success btn-sm">Edit</a>
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
            ->make(true);
    }
}
