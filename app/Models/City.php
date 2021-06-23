<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class City extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeAdminCity($query)
    {
        return $query->where('admin_id', Auth::guard('admin')->user()->id);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithoutAdminCity($query)
    {
        return $query->where('admin_id', '!=',Auth::guard('admin')->user()->id);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function subcity()
    {
        return $this->hasMany(SubCity::class);
    }
}
