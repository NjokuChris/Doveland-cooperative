<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getAutocompleteData(Request $request){
        if($request->has('term')){
            return Product::where('name','like','%'.$request->input('term').'%')->get();
        }
    }

    public function create(){
        return view('admin.invoices.create');
    }
}
