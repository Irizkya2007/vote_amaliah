<?php

namespace App\Models;

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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'roles_id', // Menambahkan role_id agar bisa diisi
        'kelas_id',
        'nisn',    // Kolom tambahan untuk siswa
        'nis',     // Kolom tambahan untuk siswa
        'nip',     // Kolom tambahan untuk guru/pegawai
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship to the Role model.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi ke Kelas (hanya untuk siswa)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function candidatesAsKetua()
    {
        return $this->hasMany(Candidate::class, 'ketua_id');
    }

    /**
     * Relasi dengan model Candidat sebagai Wakil.
     */
    public function candidatesAsWakil()
    {
        return $this->hasMany(Candidate::class, 'wakil_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
