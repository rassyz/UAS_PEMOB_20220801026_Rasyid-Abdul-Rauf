<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['user_id', 'name', 'address', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
