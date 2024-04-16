<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total = Pembayaran::sum('jumlah_bayar');
        $pembayaran = Pembayaran::orderBy('tanggal_bayar', 'desc')->limit(5)->get();
        $trx = Pembayaran::count();
        $siswa = Siswa::count();
        $kelas = Kelas::count();

        return view('pages.admin.dashboard', compact('total', 'pembayaran', 'trx', 'siswa', 'kelas'));
    }
}
