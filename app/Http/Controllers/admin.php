<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class admin extends Controller
{
        public function select_admins_using_model()
    {


    	$alladmins = App\admin::all();
    	foreach ($alladmins as $element )
    	{
    		
    		echo $element->id_admin;

    	}


    }
    public function create()
    {
    	$last_ID=DB::table('Admins')->MAX('id_admin');
    	return view('adminsform')->with('last_ID',$last_ID);
    }
    public function store(Request $request)
    {
    	return $request->all();
    }
}
