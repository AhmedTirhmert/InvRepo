<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function contact(){
        echo"Hello From contact function inside controller ";
    }

}
