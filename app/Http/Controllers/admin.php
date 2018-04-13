<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
