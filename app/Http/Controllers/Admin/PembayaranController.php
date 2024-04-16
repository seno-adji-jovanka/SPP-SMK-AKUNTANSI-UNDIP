<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Pembayaran;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade as PDF;
use App\Helpers\Bulan;


class PembayaranController extends Controller
{

//     public function __construct(){
//         $this->middleware([
//            'auth',
//            'privilege:admin'
//         ]);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->nisn) {
            // if(Siswa::where('nisn',$request->nisn)->exists() == false):
            //     Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
            //    return back();
            //     exit;
            //  endif;

            if(Siswa::where('nisn', $request->nisn)->exists() == false){
                Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini tidak ditemukan');
                return back();
            }
            else {
                return view('pages.admin.pembayaran.index', [
                    'siswa' => Siswa::where('nisn', $request->nisn)->first(),
                    'history_spp' => Pembayaran::where('nisn', $request->nisn)->get(),
                    'siswaList' => Siswa::orderBy('nama', 'asc')->get()
                ]);
            }
        }

        $siswaList = Siswa::orderBy('nama', 'asc')->get();

        return view('pages.admin.pembayaran.index', compact('siswaList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];

        $request->validate([
            'nisn' => 'required',
            'bulan_bayar' => 'required',
            'jumlah_bayar' => 'required|numeric',
            // 'status' => 'required'

         ], $message);

        //  dd($request->nisn);

        if (Pembayaran::where('nisn', '=', $request->nisn)->where('bulan_bayar', '=', $request->bulan_bayar)->count() >= 1) {
            Alert::warning('Pemberitahuan!', 'SPP sudah dibayar!');
        }

        else {
            Pembayaran::create([
                'id_petugas' => auth()->user()->id,
                'nisn' => $request->nisn,
                'tanggal_bayar' => date('Y-m-d'),
                'bulan_bayar' => $request->bulan_bayar,
                'tahun_bayar' => $request->tahun_bayar,
                'id_spp' => $request->id_spp,
                'jumlah_bayar' => $request->jumlah_bayar,
                'status' => 'LUNAS',

             ]);

             Alert::success('Berhasil!', 'Pembayaran Berhasil di Tambahkan!');
        }

         return back();
    }

    public function export(Request $request, $id_pembayaran) {

        $pembayaran = Pembayaran::findOrFail($id_pembayaran);

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);


        $pdf = PDF::loadView('pages.admin.pembayaran.cetak', [
            'pembayaran' => $pembayaran
        ]);
        return $pdf->download('LAPORAN PEMBAYARAN SPP ' . strtoupper($pembayaran->siswa->nama) . " " . date('d M Y') . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
