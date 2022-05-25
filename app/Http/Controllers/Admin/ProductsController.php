<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\Product_category;
use Illuminate\Http\Request;


class ProductsController extends Controller
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
        $arr['products'] = product::all();
        return view('admin.products.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $arr['prod_category'] = Product_category::all();
        return view('admin.products.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, product $product)
    {
        //$image = $request->file;

       // $imagename=time().'.'.$image->getclientOriginalExtension();


        if(isset($request->file) && $request->file->getClientOriginalName()){
            $ext = $request->file->getClientOriginalExtension();
            $imagename = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->file->move('productimage', $imagename);
        }
        else
        {
            $imagename = '';
        }


        $product->image = $imagename;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->descp = $request->descp;
        $product->rate = $request->rate;
        $product->save();

        return redirect('admin/products')->with('message', 'Product created successfully');
        //
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
    public function edit(product $product)
    {
        $arr['product'] = $product;
        $arr['prod_category'] = Product_category::all();
        return view('admin.products.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $image = $request->file;

        if($image){


                $ext = $request->file->getClientOriginalExtension();
                $imagename = date('YmdHis').rand(1,99999).'.'.$ext;
                $request->file->move('productimage', $imagename);

            $product->image = $imagename;
        }


        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->descp = $request->descp;
        $product->rate = $request->rate;
        $product->save();

        return redirect('admin/products');
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

    public function getProduct()
    {
        $p=product::all();

        return response()->json($p);
    }

}
