<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['user_id', 'name', 'address', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelatihans()
    {
        return $this->hasMany(Pelatihan::class);
    }

    // public function hasilpertandingans()
    // {
    //     return $this->hasMany(HasilPertandingan::class);
    // }

    // public function rankings()
    // {
    //     return $this->hasMany(Ranking::class);
    // }
}
