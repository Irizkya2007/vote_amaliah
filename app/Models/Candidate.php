<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'ketua_id',
        'wakil_id',
        'visi',
        'misi',
        'image',
    ];

    /**
     * Relasi dengan model User (ketua).
     */
    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

    /**
     * Relasi dengan model User (wakil).
     */
    public function wakil()
    {
        return $this->belongsTo(User::class, 'wakil_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'candidate_id');
    }

    /**
     * Menghitung jumlah suara yang didapatkan oleh kandidat.
     */
    public function getVoteCountAttribute()
    {
        return $this->votes()->count();
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
