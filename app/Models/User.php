<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'email', 'password', 'lname', 'phone', 'is_verified', 'google_id', 'provider'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coments()
    {
        return $this->hasMany('App\Models\Coment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderWithAdmin()
    {
        return $this->orders()->where([
            'admin_id' => Auth::guard('admin')->id(),
            'shifted' => 0
        ])
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderWithOutAdmin()
    {
        return $this->orders()
            ->where('admin_id', '!=', Auth::guard('admin')->user()->id)
            ->where(['shifted' => 0])
            ->orderBy('created_at', 'DESC');
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetActive($query)
    {
        return $query->where('is_verified', 1);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishLists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WishList::class);
    }
}
