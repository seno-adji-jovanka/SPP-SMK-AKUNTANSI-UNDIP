<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;

    protected $table = 'spp';

    protected $primaryKey = 'id_spp';

    protected $fillable = [
         'tahun', 'nominal'
    ];

    /**
   * Belongs To Spp -> User
   *
   * @return void
   */
   public function user()
   {
         return $this->belongsTo(User::class);
   }
}
