<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productsWithSold()
    {
        return $this->products()->where([
            'status' => 1
        ])
            ->orderBy('sold', 'DESC')->limit(8);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productsWithTop()
    {
        return $this->products()->where([
            'status' => 1
        ])
            ->orderBy('updated_at', 'DESC')->limit(8);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeThisAdmin($query)
    {
        return $query->where('id', Auth::guard('admin')->user()->id);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeExceptThisAdmin($query)
    {
        return $query->where('id', '!=',Auth::guard('admin')->user()->id);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
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
