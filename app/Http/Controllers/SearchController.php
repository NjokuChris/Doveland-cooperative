<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\members;
use App\Models\product;

class SearchController extends Controller
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
        return view('search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $data = product::select("name")
                ->where("name","LIKE","%{$request->search}%")
                ->get();

        return response()->json($data);
    }
}
