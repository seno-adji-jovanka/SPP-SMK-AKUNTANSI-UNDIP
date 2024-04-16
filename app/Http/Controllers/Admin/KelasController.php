<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{

    // public function __construct(){
    //     $this->middleware([
    //        'auth',
    //        'privilege:admin'
    //     ]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();

        return view('pages.admin.kelas.index', ['kelas' => $kelas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong!',
         ];

         $validasi = $request->validate([
            'nama_kelas' => 'Required',
            'keahlian' => 'Required',
         ], $messages);

         if($validasi) :
             $create = Kelas::create([
                  'nama_kelas' => $request->nama_kelas,
                  'kompetensi_keahlian' => $request->keahlian
            ]);

            if($create) :
                 Alert::success('Berhasil!', 'Data Berhasil Ditambahkan');
            else :
                 Alert::error('Gagal!', 'Data Gagal Ditambahkan');
            endif;
         endif;

        return redirect()->route('data-kelas.index');
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
    public function edit($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);
        return view('pages.admin.kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kelas)
    {
        if($update = Kelas::find($id_kelas)) :
            $stat = $update->update([
               'nama_kelas' => $request->nama_kelas,
               'kompetensi_keahlian' => $request->keahlian
            ]);
            if($stat) :
                  Alert::success('Berhasil!', 'Data Berhasil di Edit!');
               else :
                   Alert::success('Terjadi Kesalahan!', 'Data Gagal di Edit!');
                  return back();
               endif;
      endif;

        return redirect()->route('data-kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kelas)
    {
        if(Kelas::find($id_kelas)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil Dihapus');
         else :
            Alert::error('Terjadi Kesalahan!', 'Data Gagal Dihapus');
         endif;

         return back();
    }
}
