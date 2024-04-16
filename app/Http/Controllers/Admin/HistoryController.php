<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
//     public function __construct(){
//         $this->middleware([
//            'auth',
//            'privilege:admin'
//         ]);
//    }

    public function index() {
        $pembayaran = Pembayaran::select('*')->where('status', '=', 'LUNAS')->
                get('');
        // $pembayaran = Pembayaran::orderBy('tanggal_bayar', 'desc')->get();
        return view('pages.admin.history.index', compact('pembayaran'));
    }
}
