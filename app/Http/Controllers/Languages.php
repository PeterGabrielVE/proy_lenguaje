<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Languages extends Controller
{
    //
    public function index{
    	if (!(Auth::check())) {
            return redirect('/login');
        }
    	$all_langauges = \DB::select('SELECT * FROM languages');
    	return view('all_langauges_view', ['get_all_langauges_'=>$all_langauges]);
    }
}
