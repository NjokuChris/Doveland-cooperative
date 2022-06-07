<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\Commodity;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommodityController extends Controller
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
        $period_id = collect(DB::select('SELECT dbo.GetOpenCommPeriod() AS nb'))->first()->nb;

       // dd($period_id);

        if ($period_id == null) {

            return redirect('/user')->with('message2', 'Commodity Period has not been Open for commodity request!');

        }


        $product = product::paginate(12);
       // $count=cart::where('user_id',Auth::user()->id)->count();
        return view('user.comm.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;


        foreach($request->product_id as $key=>$product_id)
        {
            $comm = new Commodity;

            $comm->user_id = $user_id;
            $comm->product_id = $request->product_id[$key];
            $comm->price = $request->price[$key];
            $comm->quantity = $request->quantity[$key];
            $comm->status = 'Not Delivered';

            $comm->save();
        }

        DB::table('carts')->where('user_id',$user_id)->delete();

        return redirect()->back()->with('message', 'You Order has been confirmed successfully');
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
        //
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

    public function search(Request $request)
    {
        $search = $request->search;

        if($search=='')
        {
            $product = product::paginate(12);
            return view('user.comm.create',compact('product'));
        }

        $product = product::where('product_name', 'like', '%'.$search.'%')->get();

        return view('user.comm.create',compact('product'));
    }
}
