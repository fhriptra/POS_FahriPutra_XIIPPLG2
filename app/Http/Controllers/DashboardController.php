<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;

class DashboardController extends Controller
{
    public function __construct(
        private LaporanPenjualanService $laporanService,
        private MonitoringStokService $StokService
    ) {}

    public function index() 
    {
        $ringkasan = $this->laporanService->ringkasanHariIni();
        
        return view('dashboard', [
            'ringkasan' => $ringkasan,
            'produkStokRendah' => $this->StokService->produkStokRendah(),
            'produkStokHabis' => $this->StokService->produkStokHabis(),
        ]);
    }
}
