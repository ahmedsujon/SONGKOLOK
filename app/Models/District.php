<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class District extends Model
{
    use HasFactory;
    protected $guarded = [];


    /**
     * @param $query
     * @return mixed
     */
    public function scopeAdminDistrict($query)
    {
        return $query->where('admin_id', Auth::guard('admin')->user()->id);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithoutAdminDistrict($query)
    {
        return $query->where('admin_id', '!=',Auth::guard('admin')->user()->id);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function subcity()
    {
        return $this->hasMany(SubCity::class);
    }
}
