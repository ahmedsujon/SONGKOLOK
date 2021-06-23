<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeEventWithAdminOwner($query)
    {
        return $query->where('admin_id', Auth::guard('admin')->user()->id);
    }


    public function scopeEventWithOutAdminOwner($query)
    {
        return $query->where('admin_id', '!=',Auth::guard('admin')->user()->id);
    }

    public function scopeGetActive($query)
    {
        return $query->where('status', 1);
    }

    public function eventProducts()
    {
        return $this->hasMany(EventProduct::class, 'event_id');
    }

    public function eventWithProducts()
    {
        return $this->eventProducts()->distinct()->count('category_id');
        // dd($event->id);

    }
}
