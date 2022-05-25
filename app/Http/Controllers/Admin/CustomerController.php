<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\States;
use App\Models\Subaccountcode;
use GuzzleHttp\Psr7\Message;
use Hamcrest\Text\SubstringMatcher;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        $customer = Customer::orderBy('id', 'desc')->get();
        return view('admin.customer.index', ['customer' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['states'] = States::all();
        return view('admin.customer.create')->with($arr);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer, Subaccountcode $subaccountcode)
    {
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->phone_no = $request->phone_no;
        $customer->address = $request->address;
        $customer->state_id = $request->state_id;
        $customer->status = $request->status;
        $customer->save();

        $subaccountcode->subaccount_name = $customer->customer_name ;
        $subaccountcode->subaccountcode = $customer->id;
        $subaccountcode->subaccount_type = 2;
        $subaccountcode->status = 1;

        $subaccountcode->save();

        return redirect('admin/customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.customer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.customer.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer, Subaccountcode $subaccountcode)
    {
        $customer->customer_name = $request->customer_name;
        $customer->email = $request->email;
        $customer->phone_no = $request->phone_no;
        $customer->address = $request->address;
        $customer->state_id = $request->state_id;
        $customer->status = $request->status;
        $customer->save();


        return view('admin.customer.index');
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

    public function getCustomer()
    {
        $m=Subaccountcode::where('status', '1')->get();

        return response()->json($m);
    }
}
