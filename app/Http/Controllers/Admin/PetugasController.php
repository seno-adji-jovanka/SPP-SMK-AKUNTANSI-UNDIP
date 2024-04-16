<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller
{
//     public function __construct(){
//         $this->middleware([
//            'auth',
//            'privilege:admin'
//         ]);
//    }

   public function index()
   {
        $petugas = User::orderBy('created_at', 'asc')->get();

        return view('pages.admin.petugas.index', ['petugas' => $petugas]);
        
   }
   
   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.petugas.create');
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
          'min' => ':attribute minimal :min karakter!',
          'unique' => ':attribute sudah digunakan!',
          'max' => ':attribute maksimal :max karakter',
      ];

      $request->validate([
        //  'level' => 'required',
         'name' => 'required|max:15',
         'username' => 'required',
         'email' => 'required|unique:users',
         'password' => 'required|min:8'
      ], $messages);
      
             if(User::create([
                //   'level' => $request->level,
                  'name' => $request->name,
                  'username' => $request->username,
                  'email' => $request->email,
                  'password' => Hash::make($request->password)
              ])) :
                 Alert::success('Berhasil!', 'Data User Berhasil di Tambahkan');
            else :
               Alert::error('Terjadi Kesalahan!', 'Data User Gagal di Tambahkan');
         endif;

        return redirect()->route('data-petugas.index');
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
        $petugas = User::find($id);
        return view('pages.admin.petugas.edit', compact('petugas'));
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
      if($update = User::find($id)) :
            
      
              
            $update->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                // 'level' => $request->level
           ]);
         
           Alert::success('Berhasil!', 'Data Berhasil di Edit');
           return redirect()->route('data-petugas.index');
         
   
      endif;

        return redirect()->route('data-petugas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::find($id)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil Dihapus');
         else :
            Alert::error('Terjadi Kesalahan!', 'Data Gagal Dihapus');
         endif;

         return back();
    }
}
