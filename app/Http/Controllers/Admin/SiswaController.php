<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller
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
        $siswa = Siswa::orderBy('nama', 'asc')->get();

        return view('pages.admin.siswa.index', ['siswa' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'user' => User::find(auth()->user()->id),
            'kelas' => Kelas::all(),
            'spp' => Spp::all(),
        ];

        return view('pages.admin.siswa.create', $data);
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
            'numeric' => ':attribute harus berupa angka!',
            'integer' => ':attribute harus berupa bilangan bulat!'
         ];

        $validasi = $request->validate([
            'nisn' => 'required|numeric|unique:siswa,nisn',
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required',
            // 'password' => 'required',
            'kelas' => 'required|integer',
            'no_telp' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required',
            'spp' => 'required|integer',
        ], $messages);

        if($validasi) :
            $store = Siswa::create([
               'nisn' => $request->nisn,
               'nis' => $request->nis,
               'nama' => $request->nama,
            //    'password' => Hash::make($request->password),
               'id_kelas' => $request->kelas,
               'no_telp' => $request->no_telp,
               'jenkel' => $request->jenkel,
               'alamat' => $request->alamat,
               'id_spp' => $request->spp
             ]);
              if($store) :
                  Alert::success('Berhasil!', 'Data Berhasil di Tambahkan');
               else :
                  Alert::error('Terjadi Kesalahan!', 'Data Gagal di Tambahkan');
               endif;
        endif;

        return redirect()->route('data-siswa.index');
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
    public function edit($nisn)
    {
        $data = [
            'user' => User::find(auth()->user()->id),
            'siswa' => Siswa::find($nisn),
            'kelas' => Kelas::all(),
            'spp' => Spp::all(),
        ];

        return view('pages.admin.siswa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nisn)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute harus berupa angka!',
            'integer' => ':attribute harus berupa bilangan bulat!'
         ];

        $validasi = $request->validate([
            // 'nisn' => 'required|numeric|unique:siswa,nisn',
            // 'nis' => 'required|numeric|unique:siswa,nis',
            'nisn' => 'required|numeric',
            'nis' => 'required|numeric',
            'nama' => 'required',
            'id_kelas' => 'required|integer',
            'no_telp' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required',
            'spp' => 'required|integer',
        ], $messages);

        if($validasi) :
            $update = Siswa::findOrFail($nisn)->update([
               'nisn' => $request->nisn,
               'nis' => $request->nis,
               'nama' => $request->nama,
            //    'password' => Hash::make($request->password),
               'id_kelas' => $request->id_kelas,
               'no_telp' => $request->no_telp,
               'jenkel' => $request->jenkel,
               'alamat' => $request->alamat,
               'id_spp' => $request->spp
             ]);
              if($update) :
                  Alert::success('Berhasil!', 'Data Berhasil di Update');
               else :
                  Alert::error('Terjadi Kesalahan!', 'Data Gagal di Update');
               endif;

        endif;

        return redirect()->route('data-siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nisn)
    {
        if(Siswa::find($nisn)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil di Hapus');
        else :
            Alert::error('Terjadi Kesalahan!', 'Data Gagal di Hapus');
        endif;

      return back();
    }
}
