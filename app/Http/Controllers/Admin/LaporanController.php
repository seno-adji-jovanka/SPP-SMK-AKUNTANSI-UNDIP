<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    // public function __construct(){
    //     $this->middleware([
    //        'auth',
    //        'privilege:admin'
    //     ]);
    // }
    public function index() {

        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();

        return view('pages.admin.laporan.index', compact('kelas'));
    }

    public function getPembayaran(Request $request) {

        $kelass = $request->input('kelas');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $pembayaran = Pembayaran::query();

        if ($kelass) {
            $pembayaran->whereHas('siswa', function($q) use ($kelass){
                $q->where('id_kelas', $kelass);
            });

        }

        if ($date_from) {
            $pembayaran->where('tanggal_bayar', '>=', $date_from ?? '2021-01-01 00:00:00')->where('tanggal_bayar', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }

        return view('pages.admin.laporan.index', [
            'pembayaran' => $pembayaran->get(),
            'from' => $date_from,
            'to' => $date_to,
            'kelass' => $kelass,
            "kelas" => Kelas::orderBy('nama_kelas', 'asc')->get()
        ]);
    }

    public function export(Request $request) {

        $kelass = $request->input('kelas');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $pembayaran = Pembayaran::query();

        if ($kelass) {
            $pembayaran->whereHas('siswa', function($q) use ($kelass){
                $q->where('id_kelas', $kelass);
            });

        }

        if ($date_from) {
            $pembayaran->where('tanggal_bayar', '>=', $date_from ?? '2021-01-01 00:00:00')->where('tanggal_bayar', '<=', $date_to . ' 23:59:59' ?? date('Y-m-d H:i:s'));
        }

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        // $data = [
        //     'pembayaran' => Pembayaran::orderBy('created_at', 'DESC')->get()
        // ];


        $pdf = PDF::loadView('pages.admin.laporan.export', [
            'pembayaran' => $pembayaran->get()
        ]);
        return $pdf->download('LAPORAN_PEMBAYARAN_SPP.pdf');

    }
}
