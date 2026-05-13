<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index() {
    $logs = \App\Models\LogAktivitas::orderBy('created_at', 'desc')->paginate(20);
    return view('laporan.log_aktivitas', compact('logs'));
}
}
