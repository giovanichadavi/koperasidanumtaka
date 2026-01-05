<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class RisikoController extends Controller
{
    public function index()
    {
        $risiko = DB::table('master_peta_risiko')->get();

        return view('risiko.peta', compact('risiko'));
    }
}

