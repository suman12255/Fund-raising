<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pays;
class DonerController extends Controller
{
    function show()
    {
        $data = pays::all();
         
        return view('doner',['doners'=>$data]);
    }
}
