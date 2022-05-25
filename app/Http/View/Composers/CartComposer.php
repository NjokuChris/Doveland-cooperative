<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;

class CartComposer
{


    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countt', cart::where('user_id',Auth::user()->id)->count());
    }
}
