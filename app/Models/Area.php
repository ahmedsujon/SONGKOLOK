<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Area extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function scopeAdminArea($query)
    {
        return $query->where('admin_id', Auth::guard('admin')->user()->id);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithoutAdminArea($query)
    {
        return $query->where('admin_id', '!=',Auth::guard('admin')->user()->id);
    }
}
