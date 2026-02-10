<?php

namespace App\Http\Controllers;
use App\Models\DaftarRisiko;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

public function index()
{
    // Grafik kiri: jumlah risiko per unit/divisi
    $risikoPerUnit = DaftarRisiko::select('unit_nama', DB::raw('count(*) as total'))
        ->groupBy('unit_nama')
        ->get();

    // Grafik kanan: status tindak lanjut
    $statusRisiko = DaftarRisiko::select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->get();

    return view('dashboard', compact('risikoPerUnit', 'statusRisiko'));
}
}
