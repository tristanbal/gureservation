<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //
    public function index(){
        $data = [
            'first_name' =>'Tristan',
            'last_name' =>'Bal'
        ];
        return view('hello.index',$data);
    }
}
