<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $fillable = ['category', 'name', 'client_id','employee_id', 'training_type', 'description', 'status', 'tanggal_jam'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
