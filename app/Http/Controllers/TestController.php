<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller{

    public function index(Request $request)
    {
        $testClass = new Delivery;
      var_dump($testClass->calculation());
    }

}

