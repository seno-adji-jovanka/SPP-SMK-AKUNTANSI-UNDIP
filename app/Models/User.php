<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        // 'level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
   * Has One User -> Spp
   *
   * @return void
   */
  public function spp()
  {
       return $this->hasOne(Spp::class);
  }

    /**
     * Has One User -> Kelas
     *
     * @return void
     */
    public function kelas()
    {
        return $this->hasOne(Kelas::class);
    }

    /**
     * Belongs To Pembayaran -> User (petugas)
     *
     * @return void
     */
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

}
