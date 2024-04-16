<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spp;
use RealRashid\SweetAlert\Facades\Alert;

class SppController extends Controller
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
        $spp = Spp::orderBy('tahun', 'asc')->get();

        return view('pages.admin.spp.index', ['spp' => $spp]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.spp.create');
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
            'tahun' => 'Required',
            'nominal' => 'Required',
         ], $messages);

         if($validasi) :
             $create = Spp::create([
                  'tahun' => $request->tahun,
                  'nominal' => $request->nominal
            ]);

            if($create) :
                 Alert::success('Berhasil!', 'Data Berhasil Ditambahkan');
            else :
                 Alert::error('Gagal!', 'Data Gagal Ditambahkan');
            endif;
         endif;

        return redirect()->route('data-spp.index');
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
    public function edit($id_spp)
    {
        $spp = Spp::find($id_spp);
        return view('pages.admin.spp.edit', compact('spp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_spp)
    {
        if($update = Spp::find($id_spp)) :
            $stat = $update->update([
               'tahun' => $request->tahun,
               'nominal' => $request->nominal
            ]);
            if($stat) :
                  Alert::success('Berhasil!', 'Data Berhasil di Edit!');
               else :
                   Alert::success('Terjadi Kesalahan!', 'Data Gagal di Edit!');
                  return back();
               endif;
      endif;

        return redirect()->route('data-spp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_spp)
    {
        if(Spp::find($id_spp)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil Dihapus');
         else :
            Alert::error('Terjadi Kesalahan!', 'Data Gagal Dihapus');
         endif;

         return back();
    }
}
