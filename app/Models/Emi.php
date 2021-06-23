<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Emi extends Model
{
    use HasFactory;

    protected $table = "emis";


    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithAdminOwner($query)
    {
        return $query->where('admin_id', Auth::guard('admin')->id());
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithOutAdminOwner($query)
    {
        return $query->where('admin_id', '!=',Auth::guard('admin')->id());
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetActive($query)
    {
        return $query->where('status', 1);
    }
}
