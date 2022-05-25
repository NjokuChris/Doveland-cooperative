<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
        $user_id = Auth::user()->id;
        $cart = cart::where('user_id',$user_id)->get();
        $sumamount = cart::where('user_id',$user_id)->sum('price');

        return view('user.cart.index', compact('cart','sumamount'));
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
    public function store(Request $request)
    {
        if (Auth::id())
        {
            $user=auth()->user();
            $product=product::find($request->id);
            $cart = new cart;

            $cart->user_id = $user->id;
            $cart->name = $user->name;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->product_id = $request->id;
            $cart->product_name = $product->product_name;
            $cart->price = $product->price;
            $cart->quantity = $request->quantity;

            $cart->save();


            return redirect()->back()->with('message', 'Product Added Successfully to your CART, ENSURE TO CHECK OUT FROM CART TO COMPLETE THE PROCESS.');
        }
        else
        {
            return redirect('login');
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

        return view('user.cart.show', ['cart' => cart::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        $arr['cart'] = $cart;
        return view('user.cart.edit')->with($arr);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect('/user/cart')->with('message', 'Item have been successfully Adjusted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        $cart->delete();

        return redirect('/user/cart')->with('message', 'Item have been successfully removed from cart');
    }

    public static function count()
    {
        $count =cart::where('user_id',Auth::user()->id)->count();
        return $count;
    }
}
