<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RisikoController extends Controller
{

    public function index()
    {
        return view('risiko.index');
    }
}

