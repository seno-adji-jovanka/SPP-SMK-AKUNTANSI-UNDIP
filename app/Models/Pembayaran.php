<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
         'id_petugas', 'nisn', 'tanggal_bayar', 'bulan_bayar', 'tahun_bayar', 'id_spp', 'jumlah_bayar','status'
    ];

 /**
   * Belongs To Pembayaran -> User (petugas)
   *
   * @return void
   */
    public function user()
    {
         return $this->belongsTo(User::class,'id_petugas', 'id');
    }

 /**
   * Has Many Pembayaran -> Siswa
   *
   * @return void
   */
    public function siswa()
    {
         return $this->belongsTo(Siswa::class,'nisn','nisn');
    }
}
