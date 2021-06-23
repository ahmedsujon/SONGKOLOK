<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategory()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    public function evenProducts()
    {
        return $this->hasMany('App\Models\EventProduct');
    }

    public function eventWithProducts()
    {
        $count_date = \Carbon\Carbon::today()->format('Y-m-d');
        $event = Event::with('eventProducts')->where('start_date', '>=', $count_date)->get();
        //dd($event);
            //dd($event->id);
            return $this->evenProducts()->where([
                'event_id' => $event[0]->id
            ])
                ->orderBy('created_at', 'DESC');
           // dd($event->id);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeCategoryWithAdminOwner($query)
    {
        return $query->where('admin_id', Auth::guard('admin')->user()->id);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeCategoryWithOutAdminOwner($query)
    {
        return $query->where('admin_id', '!=',Auth::guard('admin')->user()->id);
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
