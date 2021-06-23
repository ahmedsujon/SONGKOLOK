<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function designation()
    {
        return $this->belongsTo('App\Models\Designation');
    }

    public function scopeGetActive($query)
    {
        return $query->where('status', 1);
    }
}
